<?php

namespace App\Http\Controllers;

use App\Jobs\SendCustomEmailJob;
use App\Models\EmailTemplate;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserEmailSendingController extends Controller
{
    public function create()
    {
        $templates = EmailTemplate::all();
        $employees = User::whereNot('role', 'admin')->whereNot('id', Auth::user()->id)->get();
        return view('user.email_send.create', compact('templates', 'employees'));
    }

    public function fillForm(Request $request)
    {
        $request->validate([
            'template_id' => ['required', 'exists:email_templates,id'],
            'receiver_id' => ['required', 'exists:users,id'],
        ]);

        $template = EmailTemplate::findOrFail($request->template_id);

        preg_match_all('/{{(.*?)}}/', $template->body, $matches);
        $fields = $matches[1] ?? [];

        return view('user.email_send.fill_form', [
            'template'    => $template,
            'fields'      => $fields,
            'receiver_id' => $request->receiver_id,
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'template_id' => ['required', 'exists:email_templates,id'],
            'receiver_id' => ['required', 'exists:users,id'],
            'fields'      => ['array'],
        ]);

        $template = EmailTemplate::findOrFail($request->template_id);
        $receiver = User::findOrFail($request->receiver_id);

        $body = $template->body;

        foreach ($request->input('fields', []) as $key => $value) {
            $body = str_replace('{{' . $key . '}}', $value, $body);
        }
        $sendAt = $request->sent ? Carbon::parse($request->sent) : now();

        if ($sendAt <= now()) {
            SendCustomEmailJob::dispatch(
                $receiver->email,
                $template->subject,
                $body
            );
        } else {
            SendCustomEmailJob::dispatch(
                $receiver->email,
                $template->subject,
                $body
            )->delay($sendAt);
        }
        $recurrence = $request->recurrence;

        if ($recurrence) {
            $nextRun = Carbon::now();
        } else {
            $nextRun = $sendAt;
        }

        Message::create([
            'receiver_id' => $receiver->id,
            'sender_id'   => Auth::id(),
            'subject'     => $template->subject,
            'body'        => $body,
            'sent'        => $nextRun,
            'recurrence'  => $recurrence,
            'next_run_at' => $nextRun,
            'is_read'     => 0,
        ]);

        swal('success', $sendAt <= now() ? 'Email Sent!' : 'Email Scheduled!', 'Success');
        return redirect()->route('user.messages.templates.create');
    }
}

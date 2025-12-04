<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailSendingController extends Controller
{
    public function create()
    {
        $templates = EmailTemplate::all();
        $employees = User::whereNot('role', 'admin')->get();
        return view('admin.email_send.create', compact('templates', 'employees'));
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

        return view('admin.email_send.fill_form', [
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

        Mail::raw($body, function ($message) use ($receiver, $template) {
            $message->to($receiver->email)
                ->subject($template->subject);
        });

        return redirect()->route('admin.email-send.create')
            ->with('success', 'Email berhasil dikirim ke ' . $receiver->email);
    }
}
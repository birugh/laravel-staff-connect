<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageReply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMessageController extends Controller
{

    public function index()
    {
        $recievedMail = Message::with('sender')->where('receiver_id', Auth::id())->latest()->get();
        return view('user.messages.inbox', compact('recievedMail'));
    }
    public function sent(Request $request)
    {
        $messages = Message::select(
            'messages.*',
            'sender.name as sender_name',
            'receiver.name as receiver_name'
        )
            ->join('users as sender', 'sender.id', '=', 'messages.sender_id')
            ->join('users as receiver', 'receiver.id', '=', 'messages.receiver_id')
            ->where('messages.sender_id', Auth::user()->id)
            ->latest()->paginate(10);
        return view('user.messages.sent', compact('messages'));
    }
    public function show(string $id)
    {
        $message = Message::select(
            'messages.*',
            'sender.name as sender_name',
            'sender.email as sender_email',
            'receiver.name as receiver_name',
            'receiver.email as receiver_email',
        )
            ->join('users as sender', 'sender.id', '=', 'messages.sender_id')
            ->join('users as receiver', 'receiver.id', '=', 'messages.receiver_id')
            ->where('messages.id', $id)
            ->first();
        if ($message->is_read === 0) {
            $message->update([
                'is_read' => 1
            ]);
        }
        $replies = MessageReply::select(
            'message_replies.*',
            'sender_reply.name as sender_name',
            'sender_reply.email as sender_email',
        )
            ->join('users as sender_reply', 'sender_reply.id', '=', 'message_replies.user_id')
            ->where('message_replies.message_id', $id)
            ->get();

        return view('user.messages.show', compact('message', 'replies'));
    }

    public function create()
    {
        $users = User::latest()->whereNot('id', Auth::user()->id)->latest()->get();
        return view('user.messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_id' => ['required'],
            'receiver_id' => ['required'],
            'subject' => ['required', 'min:5', 'max:50'],
            'body' => ['required', 'min:5', 'max:255'],
            'sent' => ['required'],
        ]);

        $validated['is_read'] = 0;

        Message::create($validated);

        return redirect()->route('user.messages.inbox')->with('success', 'Message berhasil di buat');
    }
}

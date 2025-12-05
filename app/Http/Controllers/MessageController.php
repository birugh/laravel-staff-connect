<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageReply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::select(
            'messages.*',
            'sender.name as sender_name',
            'receiver.name as receiver_name'
        )
            ->join('users as sender', 'sender.id', '=', 'messages.sender_id')
            ->join('users as receiver', 'receiver.id', '=', 'messages.receiver_id')
            ->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $sender = Auth::user();
        // $listReceiver = User::whereNotIn('id', [$sender])->get();
        $users = User::latest()->get();
        return view('admin.messages.create', compact('users'));
    }
    // public function create()
    // {
    //     $sender = Auth::user();
    //     $listReceiver = User::whereNotIn('id', [$sender])->get();
    //     return view('messages.create', compact(['sender', 'listReceiver']));
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_id' => ['required'],
            'receiver_id' => ['required'],
            'subject' => ['required', 'min:5', 'max:50'],
            'body' => ['required', 'min:5', 'max:255'],
            'sent' => ['required'],
        ]);

        if ($validated['sender_id'] === $validated['receiver_id']) {
            return redirect()->route('admin.messages.create')->with('error', 'Sender dan Receiver tidak boleh sama!');
        }

        $validated['is_read'] = $request->get('is_read') == 'on' ? 1 : 0;

        Message::create($validated);

        swal('success', 'Message berhasil dibuat');

        return redirect()->route('admin.messages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $message = Message::find($id)->join();
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

        $replies = MessageReply::select(
            'message_replies.*',
            'sender_reply.name as sender_name',
            'sender_reply.email as sender_email',
        )
            ->join('users as sender_reply', 'sender_reply.id', '=', 'message_replies.user_id')
            ->where('message_replies.message_id', $id)
            ->get();
        // dd($message);
        // dd($replies);

        return view('admin.messages.show', compact('message', 'replies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
        $users = User::latest()->get();
        // dd($message);
        // dd($listReceiver);
        return view('admin.messages.edit', compact(['message', 'users']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $message = Message::findOrFail($id);

        $validated = $request->validate([
            'sender_id' => ['required'],
            'receiver_id' => ['required'],
            'subject' => ['required', 'min:5', 'max:50'],
            'body' => ['required', 'min:5', 'max:255'],
            'sent' => ['required'],
        ]);

        if ($validated['sender_id'] === $validated['receiver_id']) {
            return redirect()->route('admin.messages.index')->with('error', 'Sender dan Receiver tidak boleh sama!');
        }

        $validated['is_read'] = $request->get('is_read') == 'on' ? 1 : 0;

        $message->update($validated);

        return redirect()->route('admin.messages.index')->with('success', 'Message berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message berhasil di hapus');
    }
}

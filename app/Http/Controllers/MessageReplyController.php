<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageReply;
use App\Models\User;
use Illuminate\Http\Request;

class MessageReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $replies = MessageReply::latest()->paginate(5);
        // return view('', compact('messages'));

        $replies = MessageReply::with('message')
            ->latest()
            ->paginate(10);
        // dd($messages);
        return view('replies.index', compact('replies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $sender = User::latest();
        // $listReceiver = User::whereNotIn('id', [$sender])->get();
        $messages = Message::with('sender')
            ->get();
        // dd($replies);
        $users = User::latest()->get();
        return view('replies.create', compact(['messages', 'users']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message_id' => ['required'],
            'user_id' => ['required'],
            'body' => ['required', 'min:10', 'max:255'],
        ]);

        MessageReply::create($validated);

        return redirect()->route('admin.replies.index')->with('success', 'Reply berhasil di buat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $messages = Message::with('sender')
        //     ->get();
        // // dd($replies);
        // $users = User::latest()->get();
        // return view('replies.show', compact('reply'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $messages = Message::with('sender')
            ->get();
        $users = User::latest()->get();
        $reply = MessageReply::find($id);

        return view('replies.edit', compact('messages', 'users', 'reply'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reply = MessageReply::findOrFail($id);

        $validated = $request->validate([
            'message_id' => ['required'],
            'user_id' => ['required'],
            'body' => ['required', 'min:10', 'max:255'],
        ]);

        $reply->update($validated);

        return redirect()->route('admin.replies.update')->with('success', 'Reply berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reply = MessageReply::findOrFail($id);
        $reply->delete();
        return redirect()->route('admin.replies.index')->with('success', 'Reply berhasil di hapus');
    }
}

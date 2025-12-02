<?php

namespace App\Http\Controllers;

use App\Models\MessageReply;
use Illuminate\Http\Request;

class MessageReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $replies = MessageReply::latest()->paginate(5);
        return view('', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('');
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

        return redirect('')->with('success', 'Reply berhasil di buat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reply = MessageReply::find($id);
        return view('', compact('reply'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reply = MessageReply::find($id);
        return view('', compact('reply'));
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

        return redirect('')->with('success', 'Reply berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reply = MessageReply::findOrFail($id);
        $reply->delete();
        return redirect('')->with('success', 'Reply berhasil di hapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\MessageReply;
use Illuminate\Http\Request;

class UserMessageReplyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message_id' => ['required'],
            'user_id' => ['required'],
            'body' => ['required', 'min:10', 'max:255'],
        ]);

        MessageReply::create($validated);

        return redirect()->back()->with('success', 'Reply berhasil di buat');
    }
}

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
            'body' => ['required', 'min:5', 'max:255'],
        ]);


        MessageReply::create($validated);

        swal_toast('success', 'Reply created successfully');
        return redirect()->back();
    }
}

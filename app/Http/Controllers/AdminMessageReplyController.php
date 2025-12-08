<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageReply;
use App\Models\User;
use Illuminate\Http\Request;

class AdminMessageReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->filter;
        $search = $request->search;

        $query = MessageReply::with('message', 'user');
        $countAll = (clone $query)->count();

        $countNow = (clone $query)
            ->whereDate('created_at', now()->toDateString())
            ->count();

        $countThisWeek = (clone $query)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        $query = MessageReply::with('message', 'user');

        switch ($filter) {
            case 'now':
                $query->whereDate('created_at', now()->toDateString());
                break;

            case 'this_week':
                $query->whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek(),
                ]);
                break;
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('body', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('name', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('message', function ($m) use ($search) {
                        $m->where('subject', 'LIKE', "%{$search}%");
                    });
            });
        }

        $replies = $query->latest()->paginate(10);
        return view('admin.replies.index', compact('replies', 'filter', 'search', 'countAll', 'countNow', 'countThisWeek'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $messages = Message::with('sender')
            ->get();
        $users = User::latest()->get();
        return view('admin.replies.create', compact(['messages', 'users']));
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


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MessageReply $reply)
    {
        $messages = Message::with('sender')
            ->get();
        $users = User::latest()->get();

        return view('admin.replies.edit', compact('messages', 'users', 'reply'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MessageReply $reply)
    {
        $validated = $request->validate([
            'message_id' => ['required'],
            'user_id' => ['required'],
            'body' => ['required', 'min:10', 'max:255'],
        ]);

        $reply->update($validated);
        return redirect()->route('admin.replies.index')->with('success', 'Reply berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MessageReply $reply)
    {
        $reply->delete();
        return redirect()->route('admin.replies.index')->with('success', 'Reply berhasil di hapus');
    }
}

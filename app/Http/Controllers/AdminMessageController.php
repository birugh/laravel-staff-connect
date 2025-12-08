<?php

namespace App\Http\Controllers;

use App\Jobs\SendCustomEmailJob;
use App\Models\Message;
use App\Models\MessageReply;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->filter;
        $search = $request->search;

        $query = Message::with('sender', 'receiver');
        $countAll = (clone $query)->count();

        $countNow = (clone $query)
            ->whereDate('sent', now()->toDateString())
            ->count();

        $countThisWeek = (clone $query)
            ->whereBetween('sent', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        $countUnread = (clone $query)
            ->where('is_read', 0)
            ->count();

        $query = Message::with('sender', 'receiver');

        switch ($filter) {
            case 'now':
                $query->whereDate('sent', now()->toDateString());
                break;

            case 'this_week':
                $query->whereBetween('sent', [
                    now()->startOfWeek(),
                    now()->endOfWeek(),
                ]);
                break;

            case 'unread':
                $query->where('is_read', 0);
                break;
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'LIKE', "%{$search}%")
                    ->orWhereHas('sender', function ($senderQuery) use ($search) {
                        $senderQuery->where('name', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('receiver', function ($receiverQuery) use ($search) {
                        $receiverQuery->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        $messages = $query->latest()->paginate(10);
        return view('admin.messages.index', compact('messages', 'filter', 'search', 'countAll', 'countNow', 'countThisWeek', 'countUnread'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::latest()->get();
        return view('admin.messages.create', compact('users'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_id'   => ['required', 'exists:users,id'],
            'receiver_id' => ['required', 'exists:users,id'],
            'subject'     => ['required', 'min:5', 'max:50'],
            'body'        => ['required', 'min:5', 'max:255'],
            'sent'        => ['nullable'],  // optional datetime
        ]);

        if ($validated['sender_id'] == $validated['receiver_id']) {
            return back()->with('error', 'Sender dan Receiver tidak boleh sama!');
        }

        $receiver = User::findOrFail($validated['receiver_id']);

        $sendAt = $request->sent
            ? Carbon::parse($request->sent)
            : now();

        if ($sendAt <= now()) {
            SendCustomEmailJob::dispatch(
                $receiver->email,
                $validated['subject'],
                $validated['body']
            );
        } else {
            SendCustomEmailJob::dispatch(
                $receiver->email,
                $validated['subject'],
                $validated['body']
            )->delay($sendAt);
        }

        Message::create([
            'sender_id'   => $validated['sender_id'],
            'receiver_id' => $validated['receiver_id'],
            'subject'     => $validated['subject'],
            'body'        => $validated['body'],
            'sent'        => $sendAt,
            'is_read'     => $request->get('is_read') === 'on' ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.messages.index')
            ->with('success', $sendAt <= now()
                ? 'Message berhasil dikirim!'
                : 'Message berhasil dijadwalkan!');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message = Message::with(['sender', 'receiver'])
            ->findOrFail($id);

        $replies = MessageReply::with('user')
            ->where('message_id', $id)
            ->get();

        return view('admin.messages.show', compact('message', 'replies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $message = Message::with(['sender', 'receiver'])
            ->findOrFail($id);
        $users = User::latest()->get();
        return view('admin.messages.edit', compact(['message', 'users']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
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
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message berhasil di hapus');
    }
}

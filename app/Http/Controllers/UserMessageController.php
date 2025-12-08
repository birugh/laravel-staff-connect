<?php

namespace App\Http\Controllers;

use App\Jobs\SendCustomEmailJob;
use App\Models\Message;
use App\Models\MessageReply;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMessageController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter;
        $search = $request->search;
        $sort = $request->sort;
        $dir = $request->dir;

        // --- COUNTS ---
        $query = Message::with('sender')
            ->where('receiver_id', Auth::id());
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

        $query = Message::with('sender')
            ->where('receiver_id', Auth::id());
        // --- FILTER ---
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

        // --- SORT ---
        if ($sort && $dir) {
            if (in_array($sort, ['subject', 'sent', 'is_read', 'body'])) {
                $query->orderBy($sort, $dir);
            }

            if ($sort === 'sender') {
                $query->join('users as s', 's.id', '=', 'messages.sender_id')
                    ->orderBy('s.name', $dir)
                    ->select('messages.*');
            }
        } else {
            $query->latest();
        }

        // --- SEARCH ---
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'LIKE', "%{$search}%")
                    ->orWhereHas('sender', function ($senderQuery) use ($search) {
                        $senderQuery->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        $recievedMail = $query->get();

        Message::with('sender')
            ->where('receiver_id', Auth::id())
            ->where('is_read', 0)
            ->count();

        return view('user.messages.inbox', compact(
            'recievedMail',
            'filter',
            'search',
            'countAll',
            'countNow',
            'countThisWeek',
            'countUnread'
        ));
    }



    public function sent(Request $request)
    {
        $filter = $request->filter;
        $search = $request->search;
        $sort = $request->sort;
        $dir = $request->dir;

        $query = Message::with(['sender', 'receiver'])
            ->where('sender_id', Auth::id());
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

        $query = Message::with(['sender', 'receiver'])
            ->where('sender_id', Auth::id());

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

        if ($sort && $dir) {
            if (in_array($sort, ['subject', 'sent', 'is_read'])) {
                $query->orderBy($sort, $dir);
            }

            if ($sort === 'receiver') {
                $query->join('users as r', 'r.id', '=', 'messages.receiver_id')
                    ->orderBy('r.name', $dir)
                    ->select('messages.*');
            }
        } else {
            $query->latest();
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'LIKE', "%{$search}%")
                    ->orWhereHas('receiver', function ($receiverQuery) use ($search) {
                        $receiverQuery->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        $messages = $query->paginate(10)->appends(request()->query());
        return view('user.messages.sent', compact('messages', 'filter', 'search', 'countAll', 'countNow', 'countThisWeek', 'countUnread'));
    }
    public function show(string $id)
    {
        $message = Message::with(['sender', 'receiver'])
            ->findOrFail($id);

        $replies = MessageReply::with('user')
            ->where('message_id', $id)
            ->get();
        if ($message->is_read === 0) {
            $message->update([
                'is_read' => 1
            ]);
        }
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
            'sender_id'   => ['required', 'exists:users,id'],
            'receiver_id' => ['required', 'exists:users,id'],
            'subject'     => ['nullable', 'min:5', 'max:50'],
            'body'        => ['required', 'min:5', 'max:255'],
            'sent'        => ['nullable'],
        ]);

        $receiver = User::findOrFail($request->receiver_id);

        $sendAt = $request->sent
            ? Carbon::parse($request->sent)
            : now();

        if ($sendAt <= now()) {
            SendCustomEmailJob::dispatch(
                $receiver->email,
                $request->subject,
                $request->body
            );
        } else {
            SendCustomEmailJob::dispatch(
                $receiver->email,
                $request->subject,
                $request->body
            )->delay($sendAt);
        }

        Message::create([
            'sender_id'   => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'subject'     => $request->subject,
            'body'        => $request->body,
            'sent'        => $sendAt,
            'is_read'     => 0,
        ]);

        return redirect()
            ->route('user.messages.inbox')
            ->with('success', $sendAt <= now()
                ? 'Message berhasil dikirim!'
                : 'Message berhasil dijadwalkan!');
    }
}

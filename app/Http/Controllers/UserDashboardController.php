<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter;
        $search = $request->search;
        $sort = $request->sort;
        $dir = $request->dir;

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
                    });
            });
        }

        if ($sort && $dir) {
            if (in_array($sort, ['subject', 'sent', 'is_read'])) {
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

        $sentCount = Message::where('sender_id', Auth::id())->count();
        $recievedMail = $query->paginate(10)->appends(request()->query());
        $unreadCount = $countUnread;

        return view('user.dashboard', compact('sentCount', 'recievedMail', 'unreadCount', 'filter', 'search', 'countAll', 'countNow', 'countThisWeek'));
    }
}

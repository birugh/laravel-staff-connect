<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        // $recievedCountThisWeek = Message::where('receiver_id', Auth::id())
        //     ->whereBetween('sent', [$now->startOfWeek(), $now->endOfWeek()])
        //     ->count();

        // $sentCountThisWeek = Message::where('sender_id', Auth::id())
        //     ->whereBetween('sent', [$now->startOfWeek(), $now->endOfWeek()])
        //     ->count();

        $sentCount = Message::where('sender_id', operator: Auth::id())->count();
        $recievedCount = Message::where('receiver_id', Auth::id())->count();
        $unreadCount = Message::where('receiver_id', Auth::id())->where('is_read', 0)->count();
        $recievedMail = Message::with('sender')->where('receiver_id', Auth::id())->latest()->paginate(5);
        return view('user.dashboard', compact('sentCount', 'recievedMail', 'unreadCount'));
    }
}

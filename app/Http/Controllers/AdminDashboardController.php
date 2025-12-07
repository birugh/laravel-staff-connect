<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // $recievedCountThisWeek = Message::where('receiver_id', Auth::id())
        //     ->whereBetween('sent', [$now->startOfWeek(), $now->endOfWeek()])
        //     ->count();

        // $sentCountThisWeek = Message::where('sender_id', Auth::id())
        //     ->whereBetween('sent', [$now->startOfWeek(), $now->endOfWeek()])
        //     ->count();

        // $sentCount = Message::where('sender_id', operator: Auth::id())->count();
        // $recievedCount = Message::where('receiver_id', Auth::id())->count();
        // $unreadCount = Message::where('receiver_id', Auth::id())->where('is_read', 0)->count();
        // $recievedMail = Message::with('sender')->where('receiver_id', Auth::id())->latest()->paginate(5);
        // $recievedMail = Message::with('sender')->latest()->paginate(10);
        $sentCount = Message::count();
        $recievedMail = Message::with('sender')->latest()->paginate(10);
        $pegawaiCount = User::where('role', 'pegawai')->count();
        $karyawanCount = User::where('role', 'karyawan')->count();

        $messagesPerMonth = Message::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $monthLabels = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];

        $chartData = [
            'labels' => array_values($monthLabels),
            'data' => collect(range(1, 12))
                ->map(fn($m) => (int) ($messagesPerMonth[$m] ?? 0))
                ->values()
                ->toArray()
        ];

        return view('admin.dashboard', [
            'recievedMail' => $recievedMail,
            'pegawaiCount' => $pegawaiCount,
            'karyawanCount' => $karyawanCount,
            'sentCount' => $sentCount,
            'chartData' => json_encode($chartData),
        ]);
    }
}

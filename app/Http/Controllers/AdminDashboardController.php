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
        $filter = $request->filter;
        $search = $request->search;

        $query = Message::with('sender');
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

        $query = Message::with('sender');

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

        $recievedMail = $query->latest()->paginate(10);

        // $sentCount = Message::where('sender_id', operator: Auth::id())->count();
        // $recievedCount = Message::where('receiver_id', Auth::id())->count();
        // $unreadCount = Message::where('receiver_id', Auth::id())->where('is_read', 0)->count();
        // $recievedMail = Message::with('sender')->where('receiver_id', Auth::id())->latest()->paginate(10);
        // $recievedMail = Message::with('sender')->latest()->paginate(10);
        $sentCount = Message::count();
        $petugasCount = User::where('role', 'petugas')->count();
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

        // return view('admin.dashboard', [
        //     'recievedMail' => $recievedMail,
        //     'petugasCount' => $petugasCount,
        //     'karyawanCount' => $karyawanCount,
        //     'sentCount' => $sentCount,
        //     'chartData' => json_encode($chartData),
        // ]);
        return view('admin.dashboard', compact('sentCount', 'recievedMail', 'petugasCount', 'karyawanCount', 'filter', 'search', 'countAll', 'countNow', 'countThisWeek', 'countUnread', 'chartData'));
    }
}

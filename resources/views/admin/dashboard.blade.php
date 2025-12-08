@extends('layouts.admin')
@section('content')

<div class="my-6">
    <div class="dashboard__title">
        <span>
            <h2>Dashboard Admin</h2>
            <small class="text-lg font-medium text-gray-700">Welcome {{ Auth::user()->name }}!</small>
        </span>
    </div>
    <div class="container-content">
        <canvas id="messagesChart" class="w-full" data-chart="{{ json_encode($chartData) }}"></canvas>
    </div>
    <div class="flex justify-between gap-2 w-">
        <div class="w-full max-w-[320px] py-6 px-10 bg-white rounded-md mb-8 shadow-md">
            <h3 class="font-medium text-2xl text-start mb-2">Total Petugas</h3>
            <div class="h-separator"></div>
            <small class="font-medium text-4xl">{{ $petugasCount }}</small>
        </div>
        <div class="w-full max-w-[320px] py-6 px-10 bg-white rounded-md mb-8 shadow-md">
            <h3 class="font-medium text-2xl text-start mb-2">Total Karyawan</h3>
            <div class="h-separator"></div>
            <small class="font-medium text-4xl">{{ $karyawanCount }}</small>
        </div>
        <div class="w-full max-w-[320px] py-6 px-10 bg-white rounded-md mb-8 shadow-md">
            <h3 class="font-medium text-2xl text-start mb-2">Total Mails</h3>
            <div class="h-separator"></div>
            <small class="font-medium text-4xl">{{ $sentCount }}</small>
        </div>
        <div class="w-full max-w-[320px] py-6 px-10 bg-white rounded-md mb-8 shadow-md">
            <h3 class="font-medium text-lg text-start mb-2">Top Sender</h3>
            <div class="h-separator"></div>
            <small class="font-medium text-2xl w-full">{{ Str::limit($topSender->sender->email, 15) }} ({{ $topSender['total'] }})</small>
        </div>
    </div>
    <!-- <div>
        <div>
            <div class="seperator"></div>
            <small>Sent</small>
            <p> sentCount }}</p>
            <div>
                // TODO Chart
            </div>
        </div>
    </div> -->
    <div>
        <div>
            <!--
            // TODO Icon notification
            -->
        </div>
    </div>
    <div class="bg-white rounded-lg border-2 border-gray-300 overflow-hidden">

        <table class="table table-hover mb-4">
            <tr>
                <x-th-sort column="id" label="No" />
                <x-th-sort column="subject" label="Subject" />
                <x-th-sort column="sender" label="Sender" />
                <x-th-sort column="is_read" label="Status" />
                <x-th-sort column="sent" label="Date" />
            </tr>
            @foreach ($recievedMail as $r)
            <tr>
                <td>
                    @if(request('dir') === 'desc' && request('sort') === 'id')
                    {{ $recievedMail->total() - ($recievedMail->firstItem() + $loop->index) + 1 }}
                    @else
                    {{ $recievedMail->firstItem() + $loop->index }}
                    @endif
                </td>
                <td>{{ $r->subject ?? '(No Subject)'}}</td>
                <td>{{ $r->sender?->name ?? 'USER NOT FOUND'}}</td>
                <td>
                    <span class="status-read {{ $r->is_read == 1 ? 'read' : 'unread' }}">
                        {{ $r->is_read == 0 ? 'Unread' : 'Read' }}
                </td>
                </span>
                <td>{{ $r->sentFull() }}</td>
            </tr>
            @endforeach
        </table>
        <div class="px-4 py-2 my-2">
            {{ $recievedMail->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
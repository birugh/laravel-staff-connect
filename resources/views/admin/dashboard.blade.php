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
    <div class="flex justify-between gap-2">
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
    <div>
        <table class="table table-hover mb-4">
            <tr>
                <x-th-sort column="subject" label="Subject" />
                <x-th-sort column="sender" label="Sender" />
                <x-th-sort column="is_read" label="Status" />
                <x-th-sort column="sent" label="Date" />
            </tr>
            @foreach ($recievedMail as $r)
            <tr>
                <td>{{ $r->subject }}</td>
                <td>{{ $r->sender->name }}</td>
                <td>
                    <span class="status-read {{ $r->is_read == 1 ? 'read' : 'unread' }}">
                        {{ $r->is_read == 0 ? 'Unread' : 'Read' }}
                </td>
                </span>
                <td>{{ $r->sentFull() }}</td>
            </tr>
            @endforeach
        </table>
        <div class="my-2">
            {{ $recievedMail->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
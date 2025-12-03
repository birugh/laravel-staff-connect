@extends('layouts.user')

@section('content')
    <!-- <h1> $message->subject }}</h1> -->
    <h1>Subject</h1>

    <p><strong>Dari:</strong>Joni</p>
    <p><strong>Kepada:</strong>Jonah</p>
    <p><strong>Tanggal:</strong>2005</p>
    <!-- <p><strong>Dari:</strong> $message->sender->name }}</p>
    <p><strong>Kepada:</strong> $message->receiver->name }}</p>
    <p><strong>Tanggal:</strong> $message->created_at->format('d M Y H:i') }}</p> -->

    <hr>

    <!-- <p> $message->body </p> -->

    <!-- if($message->attachment)
        <p>Lampiran: <a href=" asset('storage/' . $message->attachment) }}" download>Download</a></p>
    endif -->

    <hr>

    <h3>Balas Pesan</h3>

    <!-- <form method="POST" action=" route('messages.reply') }}"> -->
    <form method="POST" action="">
        @csrf
        <textarea name="body" rows="4" placeholder="Tulis balasan..."></textarea>
        <br>
        <button type="submit">Kirim Balasan</button>
    </form>

    <hr>

    <h3>Balasan Sebelumnya</h3>

    <!-- foreach($message->replies as $reply)
        <p>
            <strong> $reply->user->name }}:</strong> $reply->body }}<br>
            <small> $reply->created_at->diffForHumans() }}</small>
        </p>
    endforeach -->
@endsection

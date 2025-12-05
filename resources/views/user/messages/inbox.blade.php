@extends('layouts.user')

@section('content')
<div>
    <div>
        <h1>Inbox</h1>
        <small> 1.923 Email</small>
    </div>
    <form action="" method="POST">
        @csrf
        <input type="search" name="search" placeholder="Search by subject and sender">
    </form>
</div>

<div>
    <a href="">All Mail</a>
    <a href="">Now (5)</a>
    <a href="">This Week (6)</a>
    <a href="">Unread (9)</a>
</div>

<div>
    <div>
        <h2>Inbox</h2>
        <small>(23)</small>
    </div>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Subject</th>
            <th>Sender</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
        <tr>
            <td> Lorem, ipsum dolor. </td>
            <td> Lorem ipsum dolor sit amet. </td>
            <td> Read </td>
            <td>Selasa, 16 Desember 2025</td>
        </tr>
        <!-- foreach($messages as $msg)
                <tr>
                    <td> $msg->sender->name }}</td>
                    <td> $msg->subject }}</td>
                    <td> $msg->created_at->format('d M Y H:i') }}</td>
                    <td>
                        if(!$msg->is_read)
                            <span style="color:red">Belum Dibaca</span>
                        else
                            Dibaca
                        endif
                    </td>
                </tr>
            endforeach -->
    </table>
    <div>
        <!-- 
            // TODO pagination button        
            -->
        $message->links()
    </div>
</div>
@endsection
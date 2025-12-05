@extends('layouts.user')

@section('content')
<h1>Dashboard</h1>

<div>
    <div>
        <small>Received</small>
        <p>12</p>
        <div class="seperator"></div>
        <small>Sent</small>
        <p>15</p>
        <div>
            <!-- 
                // TODO Chart
            -->
        </div>
    </div>
</div>

<div>
    <div>
        <!-- 
        // TODO Icon notification
        -->
    </div>
    <div>
        <h2>Important Notification</h2>
        <p>(7) message need your immediate attention.</p>
    </div>
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
            <td>
                <span style="color:red">Belum Dibaca</span>
            </td>
            <td>
                <a href=" route('messages.show', $msg->id) }}">Lihat</a>
            </td>
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
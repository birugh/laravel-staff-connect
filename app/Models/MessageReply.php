<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageReply extends Model
{
    /** @use HasFactory<\Database\Factories\MessageReplyFactory> */
    use HasFactory;
    protected $table = 'message_replies';
    protected $fillable = ['message_id', 'user_id', 'body'];
    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

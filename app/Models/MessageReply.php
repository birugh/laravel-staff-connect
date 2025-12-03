<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class MessageReply extends Model
{
    /** @use HasFactory<\Database\Factories\MessageReplyFactory> */
    use HasFactory, SoftDeletes;
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
    public function fullCreatedAt(): Attribute
    {
        return Attribute::make(
            get: fn($v) => Carbon::parse($v)->format('d M Y, H:i'),
        );
    }
    public function limitBody()
    {
        return Str::limit($this->attributes['body'], 50);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Message extends Model
{
    /** @use HasFactory<\Database\Factories\MessageFactory> */
    use HasFactory, SoftDeletes;
    protected $table = 'messages';
    protected $fillable = ['sender_id', 'receiver_id', 'subject', 'sent', 'body'];
    public function messageReplies()
    {
        return $this->hasMany(MessageReply::class, 'message_id');
    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    protected function limitSubject()
    {
        return Str::limit($this->attributes['subject'], 30);
    }
    protected function sent(): Attribute
    {
        return Attribute::make(
            get: fn($v) => Carbon::parse($v)->format('d M'),
        );
    }
    public function sentFull()
    {
        return Carbon::parse($this->attributes['sent'])
            ->translatedFormat('d M Y, H:i');
    }
}

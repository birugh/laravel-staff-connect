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
    protected $fillable = ['sender_id', 'receiver_id', 'subject', 'sent', 'body', 'is_read'];
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
    public function limitSubject()
    {
        return Str::limit($this->attributes['subject'], limit: 20);
    }
    public function limitBody()
    {
        return Str::limit($this->attributes['body'], 30);
    }
    protected function sent(): Attribute
    {
        return Attribute::make(
            get: fn($v) => Carbon::parse($v)->format('d M'),
        );
    }
    protected function sentDate(): Attribute
    {
        return Attribute::make(
            get: fn($v) => Carbon::parse($v)->format('Y-m-d'),
        );
    }
    protected function senderName(): Attribute
    {
        return Attribute::make(
            fn() => $this->sender?->name
        );
    }
    public function sentFull()
    {
        return Carbon::parse($this->attributes['sent'])
            ->translatedFormat('d M Y, H:i');
    }
}

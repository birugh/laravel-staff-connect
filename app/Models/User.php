<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\QueuedVerifyEmail;
use App\Notifications\QueuedResetPassword;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function token()
    {
        return $this->hasMany(AuthToken::class);
    }
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }
    public function message() {
        return $this->hasMany(Message::class, 'sender_id', 'id');
    }
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id', 'id');
    }
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id', 'id');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new QueuedVerifyEmail);
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new QueuedResetPassword($token));
    }
}

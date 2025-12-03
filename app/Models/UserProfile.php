<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'user_profiles';
    protected $fillable = [
        'user_id',
        'nik',
        'phone_number',
        'address',
        'date_of_birth',
        'profile_path'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dateOfBirth()
    {
        return CastsAttribute::make(
            fn($v) => \Carbon\Carbon::parse($v)->format('d M Y')
        );
    }
}

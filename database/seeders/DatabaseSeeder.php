<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\MessageReply;
use App\Models\User;
use App\Models\UserProfile;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- Create 3 main users ---
        $admin = User::create([
            'name' => 'zulfahmi',
            'email' => 'pahmi@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'role' => 'admin',
        ]);

        $karyawan = User::create([
            'name' => 'tiara',
            'email' => 'tiara@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'role' => 'karyawan',
        ]);

        $petugas = User::create([
            'name' => 'biru',
            'email' => 'biru@gmail.com',
            'email_verified_at' => null,
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'role' => 'petugas',
        ]);

        UserProfile::factory()->create(['user_id' => $admin->id]);
        UserProfile::factory()->create(['user_id' => $karyawan->id]);
        UserProfile::factory()->create(['user_id' => $petugas->id]);

        // --- Generate random users with messages & replies ---
        User::factory()
            ->has(
                Message::factory()
                    ->has(MessageReply::factory()->count(3))
                    ->count(5)
            )
            ->count(7)
            ->create();

        // --- Email templates ---
        $this->call(EmailTemplateSeeder::class);
    }
}

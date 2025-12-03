<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\MessageReply;
use App\Models\User;
use App\Models\UserProfile;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->count(10)->create();
        User::factory()
            ->count(10)
            ->create();
        // ->has(Message::factory()
        // ->has(MessageReply::factory()
        //     ->count(3))
        // ->count(5))
    }
}

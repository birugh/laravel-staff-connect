<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\MessageReply;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            // ->has(Message::factory()
            // ->has(MessageReply::factory()
            //     ->count(3))
            // ->count(5))
            ->count(10)
            ->create();
    }
}

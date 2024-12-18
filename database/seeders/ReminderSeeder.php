<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reminder;
use App\Models\User;

class ReminderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function (User $user) {
            Reminder::factory()
                ->count(10)
                ->create([
                    'user_id' => $user->id,
                ]);
        });
    }
}

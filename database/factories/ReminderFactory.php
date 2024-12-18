<?php

namespace Database\Factories;

use App\Models\Reminder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReminderFactory extends Factory
{
    protected $model = Reminder::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'reminder_time' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => $this->faker->randomElement(['pending', 'sent', 'cancelled']),
            'notification_type' => $this->faker->randomElement(['email', 'whatsapp', 'both']),
            'email_recipient' => $this->faker->email(),
            'whatsapp_recipient' => $this->faker->phoneNumber(),
        ];
    }
}

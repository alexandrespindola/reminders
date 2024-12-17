<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reminder;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:send-reminders';
    protected $signature = 'reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send pending reminders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reminders = Reminder::where('status', 'pending')
            ->where('reminder_time', '<=', now())
            ->get();

        foreach ($reminders as $reminder) {
            $this->sendNotification($reminder);
            $reminder->update(['status' => 'sent']);
        }
    }

    private function sendNotification($reminder)
    {
        if ($reminder->notification_type == 'email' || $reminder->notification_type == 'both') {
            $this->sendEmailNotification($reminder);
        }

        if ($reminder->notification_type == 'whatsapp' || $reminder->notification_type == 'both') {
            $this->sendWhatsAppNotification($reminder);
        }
    }

    private function sendEmailNotification($reminder)
    {
        Mail::to($reminder->contact_info)->send(
            new ReminderNotification($reminder)
        );
    }

    private function sendWhatsAppNotification($reminder)
    {
        Http::post('N8N_WEBHOOK_URL', [
            'title' => $reminder->title,
            'description' => $reminder->description,
            'contact' => $reminder->contact_info
        ]);
    }
}

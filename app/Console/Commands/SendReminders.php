<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reminder;
use App\Mail\ReminderNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
            // $this->sendWhatsAppNotification($reminder);
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
        $webhookUrl = env('N8N_WEBHOOK_URL');

        $data = [
            'title' => $reminder->title,
            'whatsapp_recipient' => $reminder->whatsapp_recipient,
        ];

        $response = Http::post($webhookUrl, $data);

        // Log da resposta
        Log::info('Webhook sent', [
            'url' => $webhookUrl,
            'data' => $data,
            'response_body' => $response->body(),
            'response_status' => $response->status(),
        ]);
    }

}

<?php

namespace App\Mail;

use App\Models\Reminder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $reminder;

    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
    }

    public function build()
    {
        return $this->from('notification@mail.titansdev.es', 'My Reminder')
            ->to($this->reminder->email_recipient)
            ->subject('🔴 Reminder: ' . $this->reminder->title)
            ->view('emails.reminder');
    }
}

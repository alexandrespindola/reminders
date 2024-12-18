<?php

use Livewire\Volt\Component;

new class extends Component {
    public $reminderTitle;
    public $reminderDescription;
    public $reminderReminderTime;
    public $reminderNotificationType;
    public $reminderEmailRecipient;

    public function submit()
    {
        $validated = $this->validate([
            'reminderTitle' => 'required|max:255',
            'reminderDescription' => 'nullable',
            'reminderReminderTime' => 'required|date',
            'reminderNotificationType' => 'required|in:email,whatsapp,both',
            'reminderEmailRecipient' => 'required|email',
        ]);

        auth()
            ->user()
            ->reminders()
            ->create([
                'title' => $validated['reminderTitle'],
                'description' => $validated['reminderDescription'],
                'reminder_time' => $validated['reminderReminderTime'],
                'notification_type' => $validated['reminderNotificationType'],
                'email_recipient' => $validated['reminderEmailRecipient'],
            ]);

        redirect(route('reminders.index'));
    }
};
?>

<div>
    <form wire:submit.prevent="submit" class="space-y-4">
        <x-input wire:model="reminderTitle" label="Reminder Title" placeholder="Remember to..." />
        <x-textarea wire:model="reminderDescription" label="Description (Optional)"
            placeholder="Say something about your reminder..." />
        <x-select wire:model="reminderNotificationType" label="Select Reminder Type" placeholder="Select one"
            :options="[['name' => 'E-mail', 'value' => 'email']]" option-label="name" option-value="value" />
        <x-input wire:model="reminderEmailRecipient" label="E-mail Recipient" type="email"
            placeholder="youremail@email.com" icon="user" />
        <x-datetime-picker wire:model.live="reminderReminderTime" label="Appointment Date"
            placeholder="DD/MM/AAAA, HH:MM" />
        <div class="pt-4">
            <x-button type="submit" right-icon="calendar" spinner>Schedule Reminder</x-button>
        </div>
        <x-errors />
    </form>
</div>

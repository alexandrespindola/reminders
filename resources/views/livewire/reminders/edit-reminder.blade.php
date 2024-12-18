<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Reminder;

new #[Layout('layouts.app')] class extends Component {
    public Reminder $reminder;

    public $reminderTitle;
    public $reminderDescription;
    public $reminderReminderTime;
    public $reminderStatus;
    public $reminderNotificationType;
    public $reminderEmailRecipient;


    public function mount(reminder $reminder)
    {
        $this->authorize('update', $reminder);
        $this->fill($reminder);
        $this->reminderTitle = $reminder->title;
        $this->reminderDescription = $reminder->description;
        $this->reminderReminderTime = $reminder->reminder_time;
        $this->reminderNotificationType = $reminder->notification_type;
        $this->reminderEmailRecipient = $reminder->email_recipient;

    }

    public function saveReminder()
    {
        $validated = $this->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'reminder_time' => 'required|date',
            'notification_type' => 'required|in:email,whatsapp,both',
            'email_recipient' => 'required|email',
        ]);

        $this->reminder->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'reminder_time' => $validated['reminder_time'],
            'notification_type' => $validated['notification_type'],
            'email_recipient' => $validated['email_recipient'],
        ]);

        $this->dispatch('reminder-saved');

        /* redirect(route('reminders.index')); */
    }
}; ?>

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('reminders') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form wire:submit="saveReminder" class="space-y-4">
            <x-input wire:model="reminderTitle" label="reminder Title" placeholder="It's been a day." />
            <x-textarea wire:model="reminderBody" label="Your reminder" placeholder="Share all your thoughts with your friends."
                rows="12" />
            <x-input wire:model="reminderRecipient" label="Recipient" type="email" placeholder="yourfriend@gmail.com"
                icon="user" />
            <x-input wire:model="remindersendDate" type="date" label="Send Date" icon="calendar" />
            <x-checkbox label="reminder Published" wire:model="reminderIsPublished">Published</x-checkbox>
            <div class="flex flex-row justify-between pt-2">
                <x-button type="submit" spinner="savereminder">Save reminder</x-button>
                <x-button href="{{ route('reminders.index') }}" flat secondary>Back to reminders</x-button>
            </div>
            <x-action-message on="reminder-saved" />
            <x-errors />
        </form>
    </div>
</div>

<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Reminder;

new #[Layout('layouts.app')] class extends Component {
    public Reminder $reminder;

    public $reminderTitle;
    public $reminderDescription;
    public $reminderReminderTime;
    public $reminderNotificationType;
    public $reminderEmailRecipient;

    public function mount(Reminder $reminder)
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
            'reminderTitle' => 'required|max:255',
            'reminderDescription' => 'nullable',
            'reminderReminderTime' => 'required|date',
            'reminderNotificationType' => 'required|in:email,whatsapp,both',
            'reminderEmailRecipient' => 'required|email',
        ]);

        $this->reminder->update([
            'title' => $validated['reminderTitle'],
            'description' => $validated['reminderDescription'],
            'reminder_time' => $validated['reminderReminderTime'],
            'notification_type' => $validated['reminderNotificationType'],
            'email_recipient' => $validated['reminderEmailRecipient'],
        ]);

        $this->dispatch('note-saved');
    }
}; ?>

@section('title', 'Edit Reminder')

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Reminders') }}
    </h2>
</x-slot>

<div class="px-4 py-12 md:px-0">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form wire:submit="saveReminder" class="space-y-4">
            <x-input wire:model="reminderTitle" label="Reminder Title" placeholder="Remember to..." />
            <x-textarea wire:model="reminderDescription" label="Description (Optional)"
                placeholder="Say something about your reminder..." />
            <x-select wire:model="reminderNotificationType" label="Select Reminder Type" placeholder="Select one"
                :options="[['name' => 'E-mail', 'value' => 'email']]" option-label="name" option-value="value" />
            <x-input wire:model="reminderEmailRecipient" label="E-mail Recipient" type="email"
                placeholder="youremail@email.com" icon="user" />
            <x-datetime-picker wire:model.live="reminderReminderTime" label="Appointment Date"
                placeholder="DD/MM/AAAA, HH:MM" />
            <div class="flex flex-row justify-between pt-2">
                <x-button type="submit" spinner="saveReminder">Save Reminder</x-button>
                <x-button href="{{ route('reminders.index') }}" flat secondary>Back to Reminders</x-button>
            </div>
            <x-action-message on="note-saved" />
            <x-errors />
        </form>
    </div>
</div>

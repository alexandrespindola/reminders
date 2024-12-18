{{-- <x-app-layout>
    <h1>Create New Reminder</h1>
    <form action="{{ route('reminders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="reminder_time">Reminder Date/Time</label>
            <input type="datetime-local" name="reminder_time" id="reminder_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="notification_type">Notification Type</label>
            <select name="notification_type" id="notification_type" class="form-control" required>
                <option value="email">Email</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email_recipient">Email Recipient</label>
            <input type="text" name="email_recipient" id="email_recipient" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Reminder</button>
    </form>
</x-app-layout>
 --}}

 <x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create a Note') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto gap-y-4 sm:px-6 lg:px-8">
            {{-- <x-button icon="arrow-left" class="mb-12" href="{{ route('notes.index') }}">See Notes</x-button> --}}
            <livewire:reminders.create-reminder />
        </div>
    </div>
</x-app-layout>

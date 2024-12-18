 <x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create a Reminder') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto gap-y-4 sm:px-6 lg:px-8">
            <x-button icon="arrow-left" class="mb-12" href="{{ route('reminders.index') }}">See Reminders</x-button>
            <livewire:reminders.create-reminder />
        </div>
    </div>
</x-app-layout>

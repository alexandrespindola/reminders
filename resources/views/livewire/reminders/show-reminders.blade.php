<?php

use Livewire\Volt\Component;
use Carbon\Carbon;
use App\Models\Reminder;

new class extends Component {
    public function with(): array
    {
        return [
            'reminders' => Auth::user()->reminders()->orderBy('reminder_time', 'asc')->get(),
        ];
    }

    public function delete($reminderId)
    {
        $reminder = Reminder::findOrFail($reminderId);
        $this->authorize('delete', $reminder);
        $reminder->delete();
    }
}; ?>

<div class="space-y-4">
    @if ($reminders->isEmpty())
        <div class="text-center text-gray-500">
            <p class="text-xl font-bold">No reminders found</p>
            <p class="text-sm">Let's create your first reminder to send.</p>
            <x-button primary right-icon="plus" class="mt-6" href="{{ route('reminders.create') }}" wire:navigate>Create
                reminder</x-button>
        </div>
    @else
        <x-button primary right-icon="plus" class="mt-6 mb-8" href="{{ route('reminders.create') }}" wire:navigate>Create
            reminder</x-button>
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($reminders as $reminder)
                <x-card wire:key='card-{{ $reminder->id }}' class="flex flex-col flex-grow h-full">
                    <div class="flex justify-between flex-grow gap-4">
                        <div class="h-16 pb-4">
                            <p class="flex-grow text-xl font-bold">{{ Str::limit($reminder->title, 40, '...') }}</p>
                        </div>
                        <div class="flex flex-col gap-y-0">
                            <div class='text-xs text-gray-500 whitespace-nowrap'>
                                {{ Carbon::parse($reminder->reminder_time)->format('d-M-Y') }}
                            </div>
                            <div class='text-xs text-gray-500 whitespace-nowrap'>
                                {{ Carbon::parse($reminder->reminder_time)->format('H:m') }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row justify-between">
                        <div class="flex flex-col justify-start gap-y-1">
                            <p class='text-xs'>Status: <span
                                    class="font-semibold">{{ Str::ucfirst($reminder->status) }}</span></p>
                            </span></p>
                            <p class='text-xs'>Recipient: <span class="font-semibold">{{ $reminder->email_recipient }}
                                </span></p>
                        </div>
                        <div class='flex flex-row justify-end gap-x-2'>
                            <x-mini-button rounded slate icon="eye" href="{{ route('reminders.edit', $reminder) }}"
                                wire:navigate></x-mini-button>
                            <x-mini-button wire:click="delete('{{ $reminder->id }}')" rounded slate
                                icon="trash"></x-mini-button>
                        </div>
                    </div>

                </x-card>
            @endforeach
        </div>
    @endif
</div>

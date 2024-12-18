<?php

use Livewire\Volt\Component;

new class extends Component {

    public function with(): array
    {
        return [
            'reminders' => Auth::user()->reminders()->orderBy('reminder_time', 'asc')->get(),
        ];
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
        <div class="grid grid-cols-3 gap-4 mt-12">
            @foreach ($reminders as $reminder)
                <x-card wire:key='card-{{ $reminder->id }}' class="flex flex-col h-full">
                    <div class="flex justify-between gap-4">
                        <div class="h-16">
                            {{-- <a href="{{ route('reminders.edit', $reminder) }}" wire:navigate
                                class="text-xl font-bold hover:underline hover:text-blue-500">{{ $reminder->title }}</a> --}}
                            <p class="text-xl font-bold">{{ $reminder->title }}</p> 
                        </div>
                        {{-- <div class='p-2 text-xs text-gray-500 whitespace-nowrap'>
                            {{ Carbon::parse($reminder->send_date)->format('d-M-Y') }}
                        </div> --}}
                    </div>
{{--                     <div class="flex-grow">
                        <p class="mt-2 text-sm">{{ Str::limit($reminder->body, 50, '...') }}</p>
                    </div> --}}
                    <div class="flex flex-row justify-between mt-4 space-x-1 items">
                        {{-- <p class='text-xs'>Recipient: <span class="font-semibold">{{ $reminder->recipient }} </span></p>
                        <div>
                            <x-mini-button rounded slate icon="eye" href="{{ route('reminders.view', $reminder) }}"
                                wire:navigate></x-mini-button>
                            <x-mini-button wire:click="delete('{{ $reminder->id }}')" rounded slate
                                icon="trash"></x-mini-button>
                        </div> --}}
                    </div>
                </x-card>
            @endforeach
        </div>
    @endif
</div>

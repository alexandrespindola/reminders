{{-- <x-app-layout>
    <h1>Reminders</h1>
    <a href="{{ route('reminders.create') }}" class="btn btn-primary">Criar Novo Reminder</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Título</th>
                <th>Data/Hora</th>
                <th>Status</th>
                <th>Ações</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reminders as $reminder)
                <tr>
                    <td>{{ $reminder->title }}</td>
                    <td>{{ $reminder->reminder_time }}</td>
                    <td>{{ $reminder->status }}</td>
                    <td>
                        <a href="{{ route('reminders.edit', $reminder) }}" class="btn btn-sm btn-info">Editar</a>
                        <form action="{{ route('reminders.destroy', $reminder) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                    <td>{{ $reminder->notification_type }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
 --}}

 <x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Reminders') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <livewire:reminders.show-reminders lazy/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

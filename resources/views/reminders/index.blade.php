<x-app-layout>
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

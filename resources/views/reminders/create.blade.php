<x-app-layout>

    <h1>Criar Novo Reminder</h1>

    <form action="{{ route('reminders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="reminder_time">Data/Hora do Lembrete</label>
            <input type="datetime-local" name="reminder_time" id="reminder_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="notification_type">Tipo de Notificação</label>
            <select name="notification_type" id="notification_type" class="form-control" required>
                <option value="email">E-mail</option>
                <option value="whatsapp">WhatsApp</option>
                <option value="both">Ambos</option>
            </select>
        </div>
        <div class="form-group">
            <label for="contact_info">Informação de Contato</label>
            <input type="text" name="contact_info" id="contact_info" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Criar Reminder</button>
    </form>
</x-app-layout>

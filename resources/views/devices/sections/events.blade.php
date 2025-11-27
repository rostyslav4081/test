<div class="card mb-4">
    <div class="card-header bg-secondary text-white">
        Události
    </div>

    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Čas</th>
                <th>Událost</th>
            </tr>
            </thead>

            <tbody>
            @forelse($events as $event)
                <tr>
                    <td>{{ $event->created_at }}</td>
                    <td>{{ $event->message }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-muted">Žádné události.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

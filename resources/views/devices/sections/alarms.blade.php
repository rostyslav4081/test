<div class="card mb-4">
    <div class="card-header bg-danger text-white">
        Alarmy zařízení
    </div>
    <div class="card-body">

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Čas</th>
                <th>Úroveň</th>
                <th>Zpráva</th>
            </tr>
            </thead>

            <tbody>
            @forelse($alarms as $alarm)
                <tr>
                    <td>{{ $alarm->timestamp }}</td>
                    <td>
                        <span class="badge bg-{{ $alarm->severity }}">
                            {{ strtoupper($alarm->severity) }}
                        </span>
                    </td>
                    <td>{{ $alarm->message }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-muted">Žádné alarmy.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>

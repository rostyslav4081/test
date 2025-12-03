@extends('layouts.app')

@section('title', "Alarmy zařízení #$deviceId")

@section('content')
    <h1 class="h4 mb-3">Alarmy zařízení {{ $deviceId }}</h1>

    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm mb-3">
        ← Zpět
    </a>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-sm table-striped mb-0">
                <thead class="table-light">
                <tr>
                    <th>Kód</th>
                    <th>Popis</th>
                    <th>Čas</th>
                </tr>
                </thead>
                <tbody>
                @forelse($alarms as $alarm)
                    <tr>
                        <td>{{ $alarm->code ?? $alarm['code'] ?? '—' }}</td>
                        <td>{{ $alarm->description ?? $alarm['description'] ?? '—' }}</td>
                        <td>{{ $alarm->timestamp ?? $alarm['timestamp'] ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-3">
                            Žádné alarmy nebyly nalezeny.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

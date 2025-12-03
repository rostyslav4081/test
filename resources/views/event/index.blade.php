@extends('layouts.app')

@section('title', 'Události')

@section('content')
    <h1 class="h4 mb-3">Události</h1>

    {{-- Filters --}}
    <form method="GET" action="{{ route('events.index') }}" class="card mb-3 p-3">
        <div class="row g-2">
            <div class="col-md-3">
                <label class="form-label">Zařízení</label>
                <input type="text"
                       name="device"
                       value="{{ $filters['device'] ?? '' }}"
                       class="form-control"
                       placeholder="ID nebo název zařízení">
            </div>

            <div class="col-md-2">
                <label class="form-label">Kód události</label>
                <select name="event_code" class="form-select">
                    <option value="">— Vše —</option>
                    @foreach($eventCodes as $code)
                        <option value="{{ $code }}"
                            @selected(($filters['event_code'] ?? '') == $code)>
                            {{ $code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Od</label>
                <input type="date"
                       name="date_from"
                       value="{{ $filters['date_from'] ?? '' }}"
                       class="form-control">
            </div>

            <div class="col-md-2">
                <label class="form-label">Do</label>
                <input type="date"
                       name="date_to"
                       value="{{ $filters['date_to'] ?? '' }}"
                       class="form-control">
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-primary me-2">Filtrovat</button>

                <a href="{{ route('events.index') }}" class="btn btn-outline-secondary me-2">
                    Zrušit
                </a>

                <a class="btn btn-outline-success"
                   href="{{ route('events.export', request()->query()) }}">
                    Export CSV
                </a>
            </div>
        </div>
    </form>

    {{-- Table --}}
    <div class="card">
        <div class="table-responsive">
            <table class="table table-sm mb-0 table-striped align-middle">
                <thead class="table-light">
                <tr>
                    <th>Zařízení</th>
                    <th>Lokace</th>
                    <th>Čas</th>
                    <th>Kód</th>
                    <th>Text</th>
                    <th class="text-end"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($events as $event)
                    @php
                        $device = $event->device;
                        $location = $device?->location;
                    @endphp

                    <tr>
                        <td>
                            {{ $device->name ?? $event->deviceId }}
                            <small class="text-muted">[{{ $event->deviceId }}]</small>
                        </td>

                        <td>{{ $location->locName ?? $device->locDesc ?? '—' }}</td>

                        <td>{{ $event->timestamp->format('Y-m-d H:i:s') }}</td>

                        <td>{{ $event->event }}</td>
                        <td>{{ $event->event_text }}</td>

                        <td class="text-end">
                            <a href="{{ route('events.show', [
                                'deviceId' => $event->deviceId,
                                'timestamp' => $event->timestamp
                            ]) }}" class="btn btn-sm btn-outline-primary">
                                Detail
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-3">
                            Žádné události nenalezeny.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if($events->hasPages())
            <div class="card-footer">
                {{ $events->links() }}
            </div>
        @endif
    </div>
@endsection

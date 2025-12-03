@extends('layouts.app')

@section('title', 'Detail události')

@section('content')
    <h1 class="h4 mb-3">Detail události</h1>

    <a href="{{ route('events.index', ['device' => $event->deviceId]) }}"
       class="btn btn-outline-secondary btn-sm mb-3">
        ← Zpět na seznam
    </a>

    @php
        $device = $event->device;
        $location = $device?->location;
    @endphp

    <div class="card">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Zařízení</dt>
                <dd class="col-sm-9">
                    {{ $device->name ?? $event->deviceId }}
                    <small class="text-muted">[{{ $event->deviceId }}]</small>
                </dd>

                <dt class="col-sm-3">Lokace</dt>
                <dd class="col-sm-9">{{ $location->locName ?? $device->locDesc ?? '—' }}</dd>

                <dt class="col-sm-3">Čas</dt>
                <dd class="col-sm-9">{{ $event->timestamp->format('Y-m-d H:i:s') }}</dd>

                <dt class="col-sm-3">Kód</dt>
                <dd class="col-sm-9">{{ $event->event }}</dd>

                <dt class="col-sm-3">Text</dt>
                <dd class="col-sm-9">{{ $event->event_text }}</dd>
            </dl>
        </div>
    </div>
@endsection

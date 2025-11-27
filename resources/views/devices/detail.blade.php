@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>{{ $device->name }}</h1>

        <div class="row mb-4">

            <div class="col-md-4">
                <div class="card border-info">
                    <div class="card-body">
                        <h5>Informace</h5>
                        <p><b>IP:</b> {{ $device->ip }}</p>
                        <p><b>Typ:</b> {{ $device->type }}</p>
                        <p><b>Stav:</b>
                            <span class="badge bg-{{ $device->status }}">
                            {{ strtoupper($device->status) }}
                        </span>
                        </p>
                        <p><b>Poslední komunikace:</b> {{ $device->last_seen }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <canvas id="dcsGraph"></canvas>
            </div>

        </div>

        @include('devices.sections.snmp')
        @include('devices.sections.dcs')
        @include('devices.sections.alarms')
        @include('devices.sections.events')

    </div>
@endsection

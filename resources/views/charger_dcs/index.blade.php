@extends('layouts.app')

@section('title', 'DCS Nabíječky')

@section('content')
    <h1 class="h4 mb-3">DCS Nabíječky</h1>

    @if($devices->isEmpty())
        <div class="alert alert-info">
            Žádné DCS nabíječky nebyly nalezeny.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-sm table-striped align-middle">
                <thead>
                <tr>
                    <th>Název</th>
                    <th>Kód</th>
                    <th>Umístění</th>
                    <th>IP adresa</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($devices as $device)
                    <tr>
                        <td>{{ $device->name }}</td>
                        <td>{{ $device->code }}</td>
                        <td>{{ $device->location }}</td>
                        <td>{{ $device->ip_address }}</td>
                        <td class="text-end">
                            <a href="{{ route('charger_dcs.show', $device->id) }}" class="btn btn-sm btn-primary">
                                Detail / historie
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $devices->links() }}
    @endif
@endsection

@extends('layouts.app')

@section('content')

    <h2 class="mb-4">Dashboard</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4>📡 Poslední události (Monitor)</h4>
                    <table class="table table-sm table-bordered mt-3">
                        <thead class="table-secondary">
                        <tr>
                            <th>ID</th>
                            <th>Zařízení</th>
                            <th>Typ</th>
                            <th>Čas</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($events as $ev)
                            <tr>
                                <td>{{ $ev->id }}</td>
                                <td>{{ $ev->device_id }}</td>
                                <td>{{ $ev->event_type }}</td>
                                <td>{{ $ev->created_at }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4">Žádné záznamy</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4>📦 Sklad Pohoda</h4>
                    <table class="table table-sm table-bordered mt-3">
                        <thead class="table-secondary">
                        <tr>
                            <th>ID</th>
                            <th>Název</th>
                            <th>Cena</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($stock as $item)
                            <tr>
                                <td>{{ $item->ID }}</td>
                                <td>{{ $item->NAME }}</td>
                                <td>{{ $item->PRICE }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3">Nenašli jsme žádné položky</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

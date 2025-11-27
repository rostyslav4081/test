@extends('layouts.app')

@section('content')
    <div class="container">

        <h1 class="mb-4">Dashboard zařízení</h1>

        <!-- Summary cards -->
        <div class="row mb-4">
            @foreach([
                ['Celkem', $counts['total'], 'primary'],
                ['Online', $counts['online'], 'success'],
                ['Offline', $counts['offline'], 'danger'],
                ['Chyby', $counts['errors'], 'warning'],
                ['Varování', $counts['warnings'], 'info'],
            ] as [$label, $value, $color])
                <div class="col-md-2 mb-3">
                    <div class="card border-{{ $color }}">
                        <div class="card-body text-center">
                            <div class="fw-bold">{{ $label }}</div>
                            <div class="fs-3 text-{{ $color }}">{{ $value }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pie Chart -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4>Stav zařízení</h4>
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        <!-- Top error devices -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4>Zařízení s chybami</h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Název</th>
                        <th>Poslední chyba</th>
                        <th>Aktualizováno</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topErrors as $e)
                        <tr>
                            <td>{{ $e->name }}</td>
                            <td>{{ $e->last_error }}</td>
                            <td>{{ $e->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Latest events -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4>Poslední události</h4>
                <ul class="list-group">
                    @foreach($latestEvents as $event)
                        <li class="list-group-item">
                            <b>{{ $event->device_name }}</b>: {{ $event->message }}
                            <span class="float-end">{{ $event->created_at }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Device list -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4>Všechna zařízení</h4>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Název</th>
                        <th>Online</th>
                        <th>Status</th>
                        <th>Poslední komunikace</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deviceList as $d)
                        <tr>
                            <td>{{ $d->name }}</td>
                            <td>
                                @if($d->is_online)
                                    <span class="badge bg-success">Online</span>
                                @else
                                    <span class="badge bg-danger">Offline</span>
                                @endif
                            </td>
                            <td>{{ $d->status }}</td>
                            <td>{{ $d->last_seen }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        new Chart(document.getElementById('statusChart'), {
            type: 'pie',
            data: {
                labels: @json($statusChart['labels']),
                datasets: [{
                    data: @json($statusChart['values']),
                    backgroundColor: ['#28a745', '#dc3545']
                }]
            }
        });
    </script>
@endsection

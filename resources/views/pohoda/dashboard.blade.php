@extends('layouts.app')

@section('content')
    <div class="container">

        <h1 class="mb-4">Pohoda Dashboard</h1>

        <!-- Cards -->
        <div class="row">

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Hodnota skladu</h5>
                        <div class="fw-bold text-primary fs-3">
                            {{ number_format($stockValue, 2, ',', ' ') }} Kč
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Objednávky za 30 dní</h5>
                        <div class="fw-bold text-success fs-3">
                            {{ $orders30 }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Obrat 30 dní</h5>
                        <div class="fw-bold text-warning fs-3">
                            {{ number_format($sales30, 2, ',', ' ') }} Kč
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Graf tržeb -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4>Obrat za posledních 30 dní</h4>
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Graf skladové hodnoty -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4>Vývoj hodnoty skladu</h4>
                <canvas id="stockChart"></canvas>
            </div>
        </div>

        <!-- Top produkty -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4>Nejprodávanější produkty</h4>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Název</th>
                        <th>Množství</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($topProducts as $p)
                        <tr>
                            <td>{{ $p->NAZEV }}</td>
                            <td>{{ $p->qty }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <!-- Nízký sklad -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4>Zásoby pod minimem (≤ 5 ks)</h4>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Kód</th>
                        <th>Název</th>
                        <th>Množství</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($lowStock as $ls)
                        <tr>
                            <td>{{ $ls->KOD }}</td>
                            <td>{{ $ls->NAZEV }}</td>
                            <td class="text-danger fw-bold">{{ $ls->SKLADZASOBA }}</td>
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
        // Sales chart
        new Chart(document.getElementById('salesChart'), {
            type: 'line',
            data: {
                labels: @json($salesChart['labels']),
                datasets: [{
                    label: 'Obrat (Kč)',
                    data: @json($salesChart['values']),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    tension: 0.3
                }]
            }
        });

        // Stock chart
        new Chart(document.getElementById('stockChart'), {
            type: 'line',
            data: {
                labels: @json($stockChart['labels']),
                datasets: [{
                    label: 'Hodnota skladu',
                    data: @json($stockChart['values']),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.3
                }]
            }
        });
    </script>
@endsection

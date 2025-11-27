@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Pohoda – Panel faktur</h1>

        {{-- Filtry --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form class="row g-3" method="GET" action="{{ route('pohoda.invoices.index') }}">
                    <div class="col-md-3">
                        <label class="form-label">Od data</label>
                        <input type="date" name="from" class="form-control"
                               value="{{ $filters['from'] }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Do data</label>
                        <input type="date" name="to" class="form-control"
                               value="{{ $filters['to'] }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Odběratel</label>
                        <input type="text" name="customer" class="form-control"
                               placeholder="část názvu"
                               value="{{ $filters['customer'] }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Stav</label>
                        <select name="status" class="form-select">
                            <option value="">(vše)</option>
                            <option value="paid" {{ $filters['status'] === 'paid' ? 'selected' : '' }}>Zaplacené</option>
                            <option value="unpaid" {{ $filters['status'] === 'unpaid' ? 'selected' : '' }}>Nezaplacené</option>
                            <option value="overdue" {{ $filters['status'] === 'overdue' ? 'selected' : '' }}>Po splatnosti</option>
                        </select>
                    </div>

                    <div class="col-12 d-flex gap-2 mt-2">
                        <button class="btn btn-primary" type="submit">Filtrovat</button>
                        <a href="{{ route('pohoda.invoices.index') }}" class="btn btn-outline-secondary">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Statistiky --}}
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6>Počet faktur</h6>
                        <div class="fs-3 fw-bold">{{ $stats['totalCount'] }}</div>
                        <small class="text-muted">
                            Celkem {{ number_format($stats['totalSum'], 2, ',', ' ') }} Kč
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6>Zaplacené</h6>
                        <div class="fs-3 fw-bold text-success">{{ $stats['paidCount'] }}</div>
                        <small class="text-muted">
                            {{ number_format($stats['paidSum'], 2, ',', ' ') }} Kč
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6>Nezaplacené</h6>
                        <div class="fs-3 fw-bold text-warning">{{ $stats['unpaidCount'] }}</div>
                        <small class="text-muted">
                            {{ number_format($stats['unpaidSum'], 2, ',', ' ') }} Kč
                        </small>
                        <div class="mt-2 text-danger">
                            Po splatnosti: {{ $stats['overdueCount'] }} ks /
                            {{ number_format($stats['overdueSum'], 2, ',', ' ') }} Kč
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Graf měsíčního obratu --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4>Obrat faktur (posledních 6 měsíců)</h4>
                <canvas id="invoiceChart"></canvas>
            </div>
        </div>

        {{-- Top odběratelé --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4>TOP odběratelé</h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Odběratel</th>
                        <th>Počet faktur</th>
                        <th>Obrat (Kč)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topCusts as $c)
                        <tr>
                            <td>{{ $c->customer }}</td>
                            <td>{{ $c->invoices }}</td>
                            <td>{{ number_format($c->total, 2, ',', ' ') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tabulka faktur --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4>Seznam faktur</h4>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                        <tr>
                            <th>Číslo</th>
                            <th>Datum</th>
                            <th>Odběratel</th>
                            <th>Splatnost</th>
                            <th>Zaplaceno</th>
                            <th>Částka</th>
                            <th>Stav</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($invoices as $f)
                            <tr>
                                <td>{{ $f->CISLODOKLADU ?? $f->cislo ?? $f->ID }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($f->DATUM)->format('d.m.Y') }}</td>
                                <td>{{ $f->ODBERATEL ?? '-' }}</td>
                                <td>
                                    @if(!empty($f->DATSPLATNOSTI))
                                        {{ \Illuminate\Support\Carbon::parse($f->DATSPLATNOSTI)->format('d.m.Y') }}
                                    @else
                                        –
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($f->DATUMZAPLACENI))
                                        {{ \Illuminate\Support\Carbon::parse($f->DATUMZAPLACENI)->format('d.m.Y') }}
                                    @else
                                        <span class="text-danger">Ne</span>
                                    @endif
                                </td>
                                <td>{{ number_format($f->CELKEM ?? 0, 2, ',', ' ') }}</td>
                                <td>{{ $f->STAV ?? '' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Žádné faktury nenalezeny podle zadaných filtrů.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Stránkování --}}
                <div>
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('invoiceChart'), {
            type: 'bar',
            data: {
                labels: @json($chart['labels']),
                datasets: [{
                    label: 'Obrat (Kč)',
                    data: @json($chart['values']),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endsection

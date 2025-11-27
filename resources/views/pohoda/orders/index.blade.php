@extends('layouts.app')

@section('content')
    <div class="container">

        <h1 class="mb-4">Pohoda – Objednávky</h1>

        <!-- FILTRY -->
        <form method="GET" action="{{ route('pohoda.orders.index') }}" class="card p-3 mb-4">

            <div class="row g-3">

                <div class="col-md-3">
                    <label>Od data:</label>
                    <input type="date" name="from_date" class="form-control"
                           value="{{ $filters['from_date'] ?? '' }}">
                </div>

                <div class="col-md-3">
                    <label>Do data:</label>
                    <input type="date" name="to_date" class="form-control"
                           value="{{ $filters['to_date'] ?? '' }}">
                </div>

                <div class="col-md-3">
                    <label>Zákazník:</label>
                    <input type="text" name="customer" class="form-control"
                           placeholder="Název / IČO"
                           value="{{ $filters['customer'] ?? '' }}">
                </div>

                <div class="col-md-3">
                    <label>Hledat:</label>
                    <input type="text" name="search" class="form-control"
                           placeholder="číslo dokladu / poznámka"
                           value="{{ $filters['search'] ?? '' }}">
                </div>

            </div>

            <div class="mt-3">
                <button class="btn btn-primary">Filtrovat</button>
                <a href="{{ route('pohoda.orders.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>


        <!-- TABULKA OBJEDNÁVEK -->
        <div class="card">
            <div class="card-body p-0">

                <table class="table table-striped mb-0">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Číslo dokladu</th>
                        <th>Datum</th>
                        <th>Zákazník</th>
                        <th>Stav</th>
                        <th>Celkem (Kč)</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->ID }}</td>
                            <td>{{ $order->CISLODOKLADU }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->DATUM)->format('d.m.Y') }}</td>
                            <td>{{ $order->ODBERATEL }}</td>
                            <td><span class="badge bg-info">{{ $order->STAV }}</span></td>
                            <td>{{ number_format($order->CELKEM, 2, ',', ' ') }}</td>

                            <td>
                                <a href="{{ route('pohoda.orders.show', $order->ID) }}"
                                   class="btn btn-sm btn-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4">Žádná data</td></tr>
                    @endforelse
                    </tbody>

                </table>

            </div>
        </div>

    </div>
@endsection

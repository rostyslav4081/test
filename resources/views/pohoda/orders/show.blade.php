@extends('layouts.app')

@section('content')
    <div class="container">

        <h1 class="mb-4">
            Detaily objednávky č. {{ $order->CISLODOKLADU }}
        </h1>

        <a href="{{ route('pohoda.orders.index') }}" class="btn btn-secondary mb-3">
            ← Zpět na seznam
        </a>

        <!-- HLAVIČKA -->
        <div class="card mb-4">
            <div class="card-body">

                <h4>Informace o objednávce</h4>

                <p><strong>ID:</strong> {{ $order->ID }}</p>
                <p><strong>Datum:</strong> {{ \Carbon\Carbon::parse($order->DATUM)->format('d.m.Y') }}</p>
                <p><strong>Zákazník:</strong> {{ $order->ODBERATEL }}</p>
                <p><strong>Stav:</strong> {{ $order->STAV }}</p>
                <p><strong>Poznámka:</strong> {{ $order->POZNAMKA }}</p>
                <p><strong>Celkem:</strong> {{ number_format($order->CELKEM, 2, ',', ' ') }} Kč</p>

            </div>
        </div>


        <!-- POLOŽKY -->
        <div class="card mb-4">
            <div class="card-body p-0">

                <h4 class="p-3">Položky</h4>

                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>Pořadí</th>
                        <th>Název</th>
                        <th>Množství</th>
                        <th>Cena</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->PORADI }}</td>
                            <td>{{ $item->NAZEV ?? '—' }}</td>
                            <td>{{ $item->MNOZSTVI ?? '—' }}</td>
                            <td>{{ $item->CENA ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center py-4">Žádné položky</td></tr>
                    @endforelse
                    </tbody>

                </table>

            </div>
        </div>

    </div>
@endsection

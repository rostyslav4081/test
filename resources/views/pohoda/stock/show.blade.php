@extends('layouts.app')

@section('content')
    <div class="container">

        <h2 class="mb-4">Skladová položka: {{ $item->NAZEV }}</h2>

        <a href="{{ route('pohoda.stock.index') }}" class="btn btn-secondary mb-3">
            ← Zpět na sklad
        </a>

        <!-- Údaje o položce -->
        <div class="card mb-4">
            <div class="card-body">

                <p><strong>ID:</strong> {{ $item->ID }}</p>
                <p><strong>Kód:</strong> {{ $item->KOD }}</p>
                <p><strong>Název:</strong> {{ $item->NAZEV }}</p>
                <p><strong>MJ:</strong> {{ $item->MJ }}</p>
                <p><strong>Množství:</strong> {{ $item->SKLADZASOBA }}</p>
                <p><strong>Cena:</strong> {{ number_format($item->CENA, 2, ',', ' ') }} Kč</p>
                <p><strong>Sklad:</strong> {{ $item->SKLADCISLO }}</p>

            </div>
        </div>


        <!-- Pohyby -->
        <h3>Pohyby položky</h3>

        <div class="card">
            <div class="card-body p-0">

                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>Datum</th>
                        <th>Typ</th>
                        <th>Množství</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($movements as $m)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($m->DATUM)->format('d.m.Y H:i') }}</td>
                            <td>{{ $m->TYPPOHYBU }}</td>
                            <td>{{ $m->MNOZSTVI }}</td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>

            </div>
        </div>

    </div>
@endsection

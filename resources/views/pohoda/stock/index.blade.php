@extends('layouts.app')

@section('content')
    <div class="container">

        <h1 class="mb-4">Sklad Pohoda</h1>

        <!-- Statistika -->
        <div class="alert alert-info">
            <strong>Položek:</strong> {{ $stats['count_items'] }} |
            <strong>Celkové množství:</strong> {{ $stats['total_qty'] }} |
            <strong>Hodnota skladu:</strong> {{ number_format($stats['total_value'], 2, ',', ' ') }} Kč
        </div>

        <!-- Filtry -->
        <form class="card p-3 mb-4" method="GET">

            <div class="row g-3">

                <div class="col-md-3">
                    <label>Hledat:</label>
                    <input type="text" name="search" class="form-control"
                           placeholder="Kód nebo název"
                           value="{{ $filters['search'] ?? '' }}">
                </div>

                <div class="col-md-3">
                    <label>Sklad:</label>
                    <input type="number" name="warehouse" class="form-control"
                           placeholder="Číslo skladu"
                           value="{{ $filters['warehouse'] ?? '' }}">
                </div>

            </div>

            <div class="mt-3">
                <button class="btn btn-primary">Filtrovat</button>
                <a href="{{ route('pohoda.stock.index') }}" class="btn btn-secondary">Reset</a>
            </div>

        </form>

        <!-- Tabulka skladu -->
        <div class="card">
            <div class="card-body p-0">

                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Kód</th>
                        <th>Název</th>
                        <th>MJ</th>
                        <th>Množství</th>
                        <th>Cena</th>
                        <th>Sklad</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->ID }}</td>
                            <td>{{ $item->KOD }}</td>
                            <td>{{ $item->NAZEV }}</td>
                            <td>{{ $item->MJ }}</td>
                            <td>{{ $item->SKLADZASOBA }}</td>
                            <td>{{ number_format($item->CENA, 2, ',', ' ') }}</td>
                            <td>{{ $item->SKLADCISLO }}</td>

                            <td>
                                <a class="btn btn-sm btn-primary"
                                   href="{{ route('pohoda.stock.show', $item->ID) }}">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>

            </div>
        </div>

    </div>
@endsection

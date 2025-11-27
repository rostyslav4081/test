@extends('layouts.app')

@section('title', 'Sklad – zásoby')

@section('content')
    <h1 class="h4 mb-3">Vyhledávání zásob</h1>

    <form method="GET" action="{{ route('warehouse.search') }}" class="row g-2 mb-3">
        <div class="col-md-6">
            <input
                type="text"
                name="q"
                value="{{ $q ?? '' }}"
                class="form-control"
                placeholder="Co hledáš? (kód, název nebo souřadnice zboží)"
            >
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100" type="submit">Hledat</button>
        </div>
    </form>

    @if($items->count() === 0)
        <div class="alert alert-info">
            Nenalezeny žádné položky.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-sm table-striped align-middle">
                <thead>
                    <tr>
                        <th>Kód</th>
                        <th>EAN</th>
                        <th>Název</th>
                        <th>Množství</th>
                        <th>MJ</th>
                        <th>Umístění</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->ean }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->location }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $items->links() }}
    @endif
@endsection

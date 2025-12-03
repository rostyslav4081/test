@extends('layout')

@section('title', 'Docházka')

@section('content')
    <h1>Docházka</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Uživatel</th>
            <th>Zařízení</th>
            <th>Čas</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($items as $index => $item)
            @php
                // ID – порядковий номер у всій вибірці
                $rowId = ($items->currentPage() - 1) * $items->perPage() + $index + 1;
            @endphp
            <tr>
                <td>{{ $rowId }}</td>
                <td>{{ $item->user ?? '—' }}</td>
                {{-- у wareh_connUsers немає інформації про пристрій, залишимо поки "—" --}}
                <td>—</td>
                <td>{{ optional($item->timestamp)->format('Y-m-d H:i:s') ?? '—' }}</td>
                <td>
                    <a href="{{ route('attendance.show', $rowId) }}" class="btn btn-sm btn-primary">
                        Detail
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $items->links() }}
@endsection

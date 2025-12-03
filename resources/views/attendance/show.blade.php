@extends('layout')

@section('title', 'Detail docházky')

@section('content')
    <h1>Detail docházky</h1>

    <a href="{{ route('attendance.index') }}" class="btn btn-secondary mb-3">
        ← Zpět na seznam
    </a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $id }}</td>
        </tr>
        <tr>
            <th>Uživatel</th>
            <td>{{ $item->user ?? '—' }}</td>
        </tr>
        <tr>
            <th>Zařízení</th>
            <td>—</td>
        </tr>
        <tr>
            <th>Čas</th>
            <td>{{ optional($item->timestamp)->format('Y-m-d H:i:s') ?? '—' }}</td>
        </tr>
        <tr>
            <th>PC online</th>
            <td>{{ $item->pc_online ? 'Ano' : 'Ne' }}</td>
        </tr>
        <tr>
            <th>PC aktivní</th>
            <td>{{ $item->pc_active ? 'Ano' : 'Ne' }}</td>
        </tr>
        <tr>
            <th>Pohoda</th>
            <td>{{ $item->pohoda ? 'Ano' : 'Ne' }}</td>
        </tr>
    </table>
@endsection

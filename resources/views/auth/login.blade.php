@extends('layouts.app')

@section('title', 'Přihlášení')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <h1 class="h4 mb-3 text-center">Přihlášení</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Heslo</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    required
                >
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Zapamatovat si mě</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Přihlásit se
            </button>
        </form>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | MonitorWeb</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('overview.index') }}">MonitorWeb</a>

        <div class="d-flex">
            <span class="navbar-text text-white me-3">
                {{ auth()->user()->email }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-light btn-sm">Odhlásit se</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mb-5">
    @yield('content')
</div>

</body>
</html>

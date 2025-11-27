@extends('layouts.app')

@section('title', 'DCS Nabíječka ' . $device->name)

@section('content')
    <h1 class="h4 mb-3">
        DCS Nabíječka: {{ $device->name }}
    </h1>

    <div class="mb-3">
        <p><strong>Kód:</strong> {{ $device->code }}</p>
        <p><strong>Umístění:</strong> {{ $device->location }}</p>
        <p><strong>IP adresa:</strong> {{ $device->ip_address }}</p>
    </div>

    <hr>

    <h2 class="h5 mb-3">Historie (graf)</h2>

    <form id="history-form" class="row g-2 mb-3">
        <div class="col-md-3">
            <label class="form-label">Od (UNIX timestamp)</label>
            <input type="number" class="form-control" name="start" id="start" placeholder="např. {{ time()-3600 }}">
        </div>
        <div class="col-md-3">
            <label class="form-label">Do (UNIX timestamp)</label>
            <input type="number" class="form-control" name="end" id="end" placeholder="např. {{ time() }}">
        </div>

        <div class="col-12 mt-2">
            <label class="form-label">Zobrazené veličiny</label>
            <div class="row">
                @foreach($chartLines as $key => [$label, $unit])
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $key }}" id="line-{{ $key }}" name="checkedLines[]" checked>
                            <label class="form-check-label" for="line-{{ $key }}">
                                {{ $label }} @if($unit) [{{ $unit }}] @endif
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-12 mt-3">
            <button type="button" id="btn-load-history" class="btn btn-primary">
                Načíst data pro graf
            </button>
        </div>
    </form>

    <div id="chart-container" class="border rounded p-3">
        <pre id="chart-data" class="small text-muted">Zde budou JSON data pro graf...</pre>
    </div>

    @push('scripts')
        <script>
            document.getElementById('btn-load-history').addEventListener('click', async function () {
                const start = document.getElementById('start').value;
                const end   = document.getElementById('end').value;

                const checked = Array.from(
                    document.querySelectorAll('input[name="checkedLines[]"]:checked')
                ).map(el => el.value);

                if (!start || !end || checked.length === 0) {
                    alert('Vyplň časové rozmezí a vyber alespoň jednu veličinu.');
                    return;
                }

                const params = new URLSearchParams();
                params.append('start', start);
                params.append('end', end);
                checked.forEach(cl => params.append('checkedLines[]', cl));

                const url = "{{ route('charger_dcs.history_data', $device->id) }}?" + params.toString();

                const res = await fetch(url);
                const data = await res.json();

                document.getElementById('chart-data').textContent = JSON.stringify(data, null, 2);
                // Sem můžeš pak doplnit Highcharts/Chart.js atd.
            });
        </script>
    @endpush
@endsection

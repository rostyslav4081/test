<div class="card mb-4">
    <div class="card-header bg-warning">
        DCS data
    </div>

    <div class="card-body">

        <h5>Aktuální stav</h5>
        @if($dcs['latest'])
            <table class="table table-striped">
                <tr>
                    <th>Stav</th>
                    <td>{{ $dcs['latest']->status }}</td>
                </tr>
                <tr>
                    <th>Teplota</th>
                    <td>{{ $dcs['latest']->temperature }} °C</td>
                </tr>
                <tr>
                    <th>Výkon</th>
                    <td>{{ $dcs['latest']->power }} W</td>
                </tr>
                <tr>
                    <th>Čas</th>
                    <td>{{ $dcs['latest']->timestamp }}</td>
                </tr>
            </table>
        @else
            <p class="text-muted">Žádná aktuální DCS data.</p>
        @endif

        <hr>

        <h5>Shutdown důvody</h5>
        <ul class="list-group mb-3">
            @forelse($dcs['shutdowns'] as $item)
                <li class="list-group-item">
                    {{ $item->reason }} – <small>{{ $item->timestamp }}</small>
                </li>
            @empty
                <li class="list-group-item text-muted">Žádné záznamy.</li>
            @endforelse
        </ul>

        <h5>DTC kódy</h5>
        <ul class="list-group">
            @forelse($dcs['dtc'] as $item)
                <li class="list-group-item">
                    {{ $item->code }} – {{ $item->description }}
                    <small class="text-muted">({{ $item->timestamp }})</small>
                </li>
            @empty
                <li class="list-group-item text-muted">Žádné DTC kódy.</li>
            @endforelse
        </ul>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        SNMP informace
    </div>
    <div class="card-body">

        <table class="table table-bordered">
            <tr>
                <th>Ping</th>
                <td>
                    @if($snmp['ping'])
                        <span class="badge bg-success">Online</span>
                    @else
                        <span class="badge bg-danger">Offline</span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Uptime</th>
                <td>{{ $snmp['uptime'] ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>CPU Load</th>
                <td>{{ $snmp['cpu'] ?? 'N/A' }} %</td>
            </tr>

            <tr>
                <th>Paměť (RAM)</th>
                <td>{{ $snmp['ram'] ?? 'N/A' }} MB</td>
            </tr>

            <tr>
                <th>Teplota</th>
                <td>{{ $snmp['temp'] ?? 'N/A' }} °C</td>
            </tr>
        </table>

    </div>
</div>

<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DeviceHistoryService
{
    private string $conn = 'pgsql_monitor';

    public function getAlarms(int $deviceId)
    {
        return DB::connection($this->conn)
            ->table('alarms')
            ->where('device_id', $deviceId)
            ->orderBy('timestamp', 'desc')
            ->limit(20)
            ->get();
    }

    public function getEvents(int $deviceId)
    {
        return DB::connection($this->conn)
            ->table('events')
            ->where('device_id', $deviceId)
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();
    }

    public function dcsHistoryGraph(int $deviceId)
    {
        return DB::connection($this->conn)
            ->table('dcs_device_data')
            ->select([
                'timestamp',
                'temperature',
                'power',
            ])
            ->where('device_id', $deviceId)
            ->orderBy('timestamp')
            ->limit(100)
            ->get();
    }
}

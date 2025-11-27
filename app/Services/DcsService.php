<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DcsService
{
    private string $conn = 'pgsql_monitor';

    public function getDcsData(int $deviceId)
    {
        return DB::connection($this->conn)
            ->table('dcs_device_data')
            ->where('device_id', $deviceId)
            ->orderBy('timestamp', 'desc')
            ->first();
    }

    public function getShutdownReasons(int $deviceId)
    {
        return DB::connection($this->conn)
            ->table('dcs_shutdowns')
            ->where('device_id', $deviceId)
            ->orderBy('timestamp', 'desc')
            ->limit(20)
            ->get();
    }

    public function getDtcCodes(int $deviceId)
    {
        return DB::connection($this->conn)
            ->table('dcs_dtc_codes')
            ->where('device_id', $deviceId)
            ->orderBy('timestamp', 'desc')
            ->limit(20)
            ->get();
    }
}

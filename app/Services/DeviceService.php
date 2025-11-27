<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DeviceService
{
    private string $conn = 'pgsql_monitor';

    public function getDevice(int $id)
    {
        return DB::connection($this->conn)
            ->table('charger_dcs_devices')
            ->where('id', $id)
            ->first();
    }

    public function getStatusClass(string $status): string
    {
        return match ($status) {
            'ok'      => 'success',
            'warning' => 'warning',
            'error'   => 'danger',
            default   => 'secondary',
        };
    }
}

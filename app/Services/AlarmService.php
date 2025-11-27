<?php

namespace App\Services;

class AlarmService
{
    public function getDeviceAlarms(object $device)
    {
        return DB::connection('pgsql_monitor')
            ->table('data_alarms')
            ->where('device_id', $device->id)
            ->orderByDesc('created_at')
            ->limit(100)
            ->get();
    }
}

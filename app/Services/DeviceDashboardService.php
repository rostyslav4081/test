<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeviceDashboardService
{
    private string $conn = 'pgsql_monitor';

    public function counts(): array
    {
        return [
            'total'   => $this->devices()->count(),
            'online'  => $this->devices()->where('is_online', true)->count(),
            'offline' => $this->devices()->where('is_online', false)->count(),
            'errors'  => $this->devices()->where('status', 'error')->count(),
            'warnings'=> $this->devices()->where('status', 'warning')->count(),
        ];
    }

    public function latestEvents(int $limit = 10)
    {
        return DB::connection($this->conn)
            ->table('events')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function topErrorDevices(int $limit = 5)
    {
        return DB::connection($this->conn)
            ->table('charger_dcs_devices')
            ->select('name', 'last_error', 'updated_at')
            ->whereNotNull('last_error')
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function statusChart()
    {
        $online  = $this->devices()->where('is_online', true)->count();
        $offline = $this->devices()->where('is_online', false)->count();

        return [
            'labels' => ['Online', 'Offline'],
            'values' => [$online, $offline],
        ];
    }

    public function deviceList()
    {
        return $this->devices()
            ->orderBy('name')
            ->get();
    }

    private function devices()
    {
        return DB::connection($this->conn)->table('charger_dcs_devices');
    }
}

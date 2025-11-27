<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ChargerService
{
    protected string $connection;

    public function __construct()
    {
        // PostgreSQL monitor db
        $this->connection = 'pgsql_monitor';
    }

    /**
     * Получить заряд по device_id
     */
    public function getCharge(string $deviceId): ?array
    {
        return DB::connection($this->connection)
            ->table('charge_sh')
            ->where('device_id', $deviceId)
            ->orderByDesc('created_at')
            ->first();
    }

    /**
     * История заряда
     */
    public function history(string $deviceId, int $limit = 100): array
    {
        return DB::connection($this->connection)
            ->table('charge_sh')
            ->where('device_id', $deviceId)
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    /**
     * Последние значения заряда по всем устройствам
     */
    public function latest(int $limit = 50): array
    {
        return DB::connection($this->connection)
            ->table('charge_sh')
            ->select(DB::raw('DISTINCT ON (device_id) *'))
            ->orderBy('device_id')
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    /**
     * Сохранить новое состояние заряда
     */
    public function save(array $data): bool
    {
        return DB::connection($this->connection)
            ->table('charge_sh')
            ->insert($data);
    }
}

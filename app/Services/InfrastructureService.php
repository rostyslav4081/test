<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Základní service pro modul Infrastructure.
 * Zatím obsahuje jen jednoduché helpery, které je možné rozšířit
 * podle detailní logiky původní aplikace.
 */
class InfrastructureService
{
    public function getAll(): array
    {
        return DB::connection('pgsql_monitor')
            ->table('sys_deviceUptime')
            ->orderBy('id')
            ->get()
            ->toArray();
    }

    public function find(int $id): ?object
    {
        return DB::connection('pgsql_monitor')
            ->table('sys_deviceUptime')
            ->where('id', $id)
            ->first();
    }
}

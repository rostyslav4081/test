<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Základní service pro modul Software.
 * Zatím obsahuje jen jednoduché helpery, které je možné rozšířit
 * podle detailní logiky původní aplikace.
 */
class SoftwareService
{
    public function getAll(): array
    {
        return DB::connection('pgsql')
            ->table('sys_metrics')
            ->orderBy('id')
            ->get()
            ->toArray();
    }

    public function find(int $id): ?object
    {
        return DB::connection('pgsql')
            ->table('sys_metrics')
            ->where('id', $id)
            ->first();
    }
}

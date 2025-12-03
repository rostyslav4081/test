<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Základní service pro modul Production.
 * Zatím obsahuje jen jednoduché helpery, které je možné rozšířit
 * podle detailní logiky původní aplikace.
 */
class ProductionService
{
    public function getAll(): array
    {
        return DB::connection('pgsql_monitor')
            ->table('wareh_manufHist')
            ->orderBy('id')
            ->get()
            ->toArray();
    }

    public function find(int $id): ?object
    {
        return DB::connection('pgsql_monitor')
            ->table('wareh_manufHist')
            ->where('id', $id)
            ->first();
    }
}

<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Základní service pro modul Help.
 * Zatím obsahuje jen jednoduché helpery, které je možné rozšířit
 * podle detailní logiky původní aplikace.
 */
class HelpService
{
    public function getAll(): array
    {
        return DB::connection('pgsql')
            ->table('sys_notification')
            ->orderBy('id')
            ->get()
            ->toArray();
    }

    public function find(int $id): ?object
    {
        return DB::connection('pgsql')
            ->table('sys_notification')
            ->where('id', $id)
            ->first();
    }
}

<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Základní service pro modul Svn.
 * Zatím obsahuje jen jednoduché helpery, které je možné rozšířit
 * podle detailní logiky původní aplikace.
 */
class SvnService
{
    public function getAll(): array
    {
        return DB::connection('pgsql')
            ->table('sys_elbasPush')
            ->orderBy('id')
            ->get()
            ->toArray();
    }

    public function find(int $id): ?object
    {
        return DB::connection('pgsql')
            ->table('sys_elbasPush')
            ->where('id', $id)
            ->first();
    }
}

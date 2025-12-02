<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Základní service pro modul UserSettings.
 * Zatím obsahuje jen jednoduché helpery, které je možné rozšířit
 * podle detailní logiky původní aplikace.
 */
class UserSettingsService
{
    public function getAll(): array
    {
        return DB::connection('pgsql')
            ->table('sys_users')
            ->orderBy('id')
            ->get()
            ->toArray();
    }

    public function find(int $id): ?object
    {
        return DB::connection('pgsql')
            ->table('sys_users')
            ->where('id', $id)
            ->first();
    }
}

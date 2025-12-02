<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Základní service pro modul Settings.
 * Zatím obsahuje jen jednoduché helpery, které je možné rozšířit
 * podle detailní logiky původní aplikace.
 */
class SettingsService
{
    public function getAll(): array
    {
        return DB::connection('pgsql')
            ->table('sys_notificationSetting')
            ->orderBy('id')
            ->get()
            ->toArray();
    }

    public function find(int $id): ?object
    {
        return DB::connection('pgsql')
            ->table('sys_notificationSetting')
            ->where('id', $id)
            ->first();
    }
}

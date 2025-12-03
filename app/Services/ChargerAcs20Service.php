<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Service třída pro logiku modulu ChargerAcs20.
 * Metody zde jsou zjednodušené kostry, které je možné dále rozšířit
 * podle potřeb (přepis logiky z původního Nette projektu).
 */
class ChargerAcs20Service
{
    /**
     * Vrátí základní záznam info pro dané zařízení.
     */
    public function getInfo(int $deviceId): ?object
    {
        return DB::connection('pgsql_monitor')
            ->table('data_acs20Info')
            ->where('deviceId', $deviceId)
            ->first();
    }

    /**
     * Vrátí jednoduchou historii pro dané zařízení.
     */
    public function getHistory(int $deviceId, int $limit = 500): array
    {
        return DB::connection('pgsql_monitor')
            ->table('data_acs20History')
            ->where('deviceId', $deviceId)
            ->orderBy('timestamp', 'DESC')
            ->limit($limit)
            ->get()
            ->toArray();
    }
}

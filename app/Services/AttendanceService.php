<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Základní service pro modul Attendance.
 * Zatím obsahuje jen jednoduché helpery, které je možné rozšířit
 * podle detailní logiky původní aplikace.
 */
class AttendanceService
{
    public function getAll(): array
    {
        return DB::connection('pgsql')
            ->table('wareh_emploee')
            ->orderBy('id')
            ->get()
            ->toArray();
    }

    public function find(int $id): ?object
    {
        return DB::connection('pgsql')
            ->table('wareh_emploee')
            ->where('id', $id)
            ->first();
    }
}

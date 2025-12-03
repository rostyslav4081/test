<?php

namespace App\Services;

use App\Models\WarehConnUser;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AttendanceService
{
    /**
     * Список підключень – останні зверху.
     */
    public function getAll(int $perPage = 50): LengthAwarePaginator
    {
        return WarehConnUser::query()
            ->orderByDesc('timestamp')
            ->paginate($perPage);
    }

    /**
     * "ID" – це просто порядковий номер у відсортованому списку.
     * 1 -> перший запис, 2 -> другий і т.д.
     */
    public function findByIndex(int $index): WarehConnUser
    {
        return WarehConnUser::query()
            ->orderByDesc('timestamp')
            ->skip($index - 1)
            ->firstOrFail();
    }
}

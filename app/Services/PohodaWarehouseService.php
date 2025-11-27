<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PohodaWarehouseService
{
    private string $connection = 'sqlsrv_pohoda';

    private string $table = 'SKLADPOLOZKA';   // ← часто реальна таблиця в Pohodě

    public function getWarehouseItems(array $filters = []): Collection
    {
        $db = DB::connection($this->connection);

        $query = $db->table($this->table)
            ->select([
                'ID',
                'KOD',          // kód artiklu
                'NAZEV',        // název
                'MJ',           // měrná jednotka
                'CENA',         // cena
                'KDISP'         // dostupné množství
            ])
            ->orderBy('NAZEV');

        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            $query->where(function ($q) use ($search) {
                $q->where('KOD', 'LIKE', "%$search%")
                    ->orWhere('NAZEV', 'LIKE', "%$search%");
            });
        }

        if (!empty($filters['min_qty'])) {
            $query->where('KDISP', '>=', (int)$filters['min_qty']);
        }

        if (!empty($filters['max_qty'])) {
            $query->where('KDISP', '<=', (int)$filters['max_qty']);
        }

        return $query->limit(200)->get();
    }

    public function getItemById(int $id): ?object
    {
        return DB::connection($this->connection)
            ->table($this->table)
            ->where('ID', $id)
            ->first();
    }
}

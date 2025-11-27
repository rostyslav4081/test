<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class PohodaStockService
{
    private string $connection = 'sqlsrv_pohoda';

    private string $stockTable = 'SKLAD';
    private string $stockMovesTable = 'SKLADPOL';

    /**
     * Získat seznam skladových položek s volitelnými filtry.
     */
    public function getStock(array $filters = [], int $limit = 200): Collection
    {
        $db = DB::connection($this->connection);

        $query = $db->table($this->stockTable)
            ->select([
                'ID',
                'KOD',
                'NAZEV',
                'MJ',
                'CENA',
                'SKLADZASOBA',
                'SKLADCISLO',
            ])
            ->orderBy('KOD');

        // Hledání podle kódu / názvu
        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            $query->where(function ($q) use ($search) {
                $q->where('KOD', 'LIKE', "%{$search}%")
                    ->orWhere('NAZEV', 'LIKE', "%{$search}%");
            });
        }

        // Filtrování podle čísla skladu
        if (!empty($filters['warehouse'])) {
            $query->where('SKLADCISLO', $filters['warehouse']);
        }

        return $query->limit($limit)->get();
    }

    /**
     * Detail jedné položky
     */
    public function getItem(int $id): ?object
    {
        return DB::connection($this->connection)
            ->table($this->stockTable)
            ->where('ID', $id)
            ->first();
    }

    /**
     * Pohyby skladové položky (SKLADPOL)
     */
    public function getItemMovements(int $id, int $limit = 50): Collection
    {
        return DB::connection($this->connection)
            ->table($this->stockMovesTable)
            ->where('SKLAD_ID', $id)
            ->orderByDesc('DATUM')
            ->limit($limit)
            ->get();
    }

    /**
     * Základní statistika skladu
     */
    public function getStockStats(): array
    {
        $db = DB::connection($this->connection);

        $count = $db->table($this->stockTable)->count();
        $sumQty = $db->table($this->stockTable)->sum('SKLADZASOBA');
        $sumValue = $db->table($this->stockTable)
            ->select(DB::raw('SUM(SKLADZASOBA * CENA) as total'))
            ->first()->total ?? 0;

        return [
            'count_items' => $count,
            'total_qty'   => $sumQty,
            'total_value' => $sumValue,
        ];
    }
}

<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Služba pro čtení objednávek z Pohoda MSSQL.
 * ----------------------------------------------------
 * Uprav pouze názvy sloupců pokud máš v Pohodě jiné!
 */
class PohodaOrdersService
{
    /**
     * Jméno connection ze souboru config/database.php
     */
    private string $connectionName = 'sqlsrv_pohoda';

    /**
     * Tabulky v Pohodě.
     */
    private string $ordersTable = 'OBCHDOKLAD';
    private string $orderItemsTable = 'OBCHDOKLADPOLOZKA';

    /**
     * Vrátí seznam objednávek (včetně filtrů).
     */
    public function getOrders(array $filters = [], int $limit = 100): Collection
    {
        $db = DB::connection($this->connectionName);

        $query = $db->table($this->ordersTable)
            ->select([
                'ID',
                'CISLODOKLADU',
                'DATUM',
                'ODBERATEL',
                'STAV',
                'CELKEM',
                'POZNAMKA',
            ])
            ->orderByDesc('DATUM');

        // -----------------------------
        // FILTRY
        // -----------------------------

        if (!empty($filters['from_date'])) {
            $query->where('DATUM', '>=', Carbon::parse($filters['from_date'])->startOfDay());
        }

        if (!empty($filters['to_date'])) {
            $query->where('DATUM', '<=', Carbon::parse($filters['to_date'])->endOfDay());
        }

        if (!empty($filters['customer'])) {
            $customer = trim($filters['customer']);
            $query->where(function ($q) use ($customer) {
                $q->where('ODBERATEL', 'LIKE', "%{$customer}%")
                    ->orWhere('ICO', 'LIKE', "%{$customer}%");
            });
        }

        if (!empty($filters['status'])) {
            $query->where('STAV', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $value = trim($filters['search']);
            $query->where(function ($q) use ($value) {
                $q->where('CISLODOKLADU', 'LIKE', "%{$value}%")
                    ->orWhere('POZNAMKA', 'LIKE', "%{$value}%");
            });
        }

        return $query->limit($limit)->get();
    }

    /**
     * Vrátí jednu objednávku podle ID.
     */
    public function getOrderById(int $id): ?object
    {
        return DB::connection($this->connectionName)
            ->table($this->ordersTable)
            ->where('ID', $id)
            ->first();
    }

    /**
     * Vrátí objednávku + všechny položky.
     */
    public function getOrderWithItems(int $id): ?object
    {
        $db = DB::connection($this->connectionName);

        $order = $this->getOrderById($id);

        if (!$order) {
            return null;
        }

        $items = $db->table($this->orderItemsTable)
            ->where('IDDOKLAD', $id)
            ->orderBy('PORADI')
            ->get();

        return (object) [
            'order' => $order,
            'items' => $items,
        ];
    }

    /**
     * Vrátí poslední objednávky bez filtrů.
     */
    public function getLastOrders(int $limit = 20): Collection
    {
        return $this->getOrders([], $limit);
    }

    /**
     * Vrátí statistiky objednávek.
     */
    public function getOrdersStats(?string $from = null, ?string $to = null): array
    {
        $db = DB::connection($this->connectionName);
        $query = $db->table($this->ordersTable);

        if ($from) {
            $query->where('DATUM', '>=', Carbon::parse($from)->startOfDay());
        }
        if ($to) {
            $query->where('DATUM', '<=', Carbon::parse($to)->endOfDay());
        }

        return [
            'count' => (clone $query)->count(),
            'sum'   => (clone $query)->sum('CELKEM'),
        ];
    }
}

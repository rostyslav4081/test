<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PohodaDashboardService
{
    private string $conn = 'sqlsrv_pohoda';

    private string $orders = 'OBCHDOKLAD';
    private string $orderItems = 'OBCHDOKLADPOLOZKA';
    private string $stock = 'SKLAD';
    private string $stockMoves = 'SKLADPOL';

    /**
     * Celková hodnota skladu = SUM(množství * cena)
     */
    public function stockValue(): float
    {
        return (float) DB::connection($this->conn)
            ->table($this->stock)
            ->select(DB::raw("SUM(SKLADZASOBA * CENA) as total"))
            ->value('total') ?? 0;
    }

    /**
     * Počet objednávek za posledních X dní
     */
    public function ordersCount(int $days = 30): int
    {
        return DB::connection($this->conn)
            ->table($this->orders)
            ->where('DATUM', '>=', Carbon::now()->subDays($days))
            ->count();
    }

    /**
     * Obrat = SUM(CELKEM)
     */
    public function salesTotal(int $days = 30): float
    {
        return (float) DB::connection($this->conn)
            ->table($this->orders)
            ->where('DATUM', '>=', Carbon::now()->subDays($days))
            ->sum('CELKEM');
    }

    /**
     * Nejprodávanější položky za X dní
     */
    public function topProducts(int $limit = 10, int $days = 30): array
    {
        return DB::connection($this->conn)
            ->table($this->orderItems)
            ->select([
                'NAZEV',
                DB::raw('SUM(MNOZSTVI) as qty')
            ])
            ->where('DATUM', '>=', Carbon::now()->subDays($days))
            ->groupBy('NAZEV')
            ->orderByDesc('qty')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    /**
     * Položky pod minimální zásobou
     */
    public function lowStock(int $threshold = 5): array
    {
        return DB::connection($this->conn)
            ->table($this->stock)
            ->where('SKLADZASOBA', '<=', $threshold)
            ->orderBy('SKLADZASOBA')
            ->get()
            ->toArray();
    }

    /**
     * Data pro graf obratu podle dní
     */
    public function salesChart(int $days = 30): array
    {
        $results = DB::connection($this->conn)
            ->table($this->orders)
            ->select([
                DB::raw("CAST(DATUM AS DATE) as day"),
                DB::raw("SUM(CELKEM) as total")
            ])
            ->where('DATUM', '>=', Carbon::now()->subDays($days))
            ->groupBy(DB::raw("CAST(DATUM AS DATE)"))
            ->orderBy('day')
            ->get();

        return [
            'labels' => $results->pluck('day')->toArray(),
            'values' => $results->pluck('total')->toArray(),
        ];
    }

    /**
     * Data pro graf skladové hodnoty dle posledních 10 stavů
     */
    public function stockChart(): array
    {
        $results = DB::connection($this->conn)
            ->table($this->stockMoves)
            ->select([
                DB::raw("CAST(DATUM AS DATE) as day"),
                DB::raw("SUM(MNOZSTVI * CENA) as value")
            ])
            ->groupBy(DB::raw("CAST(DATUM AS DATE)"))
            ->orderBy('day')
            ->limit(12)
            ->get();

        return [
            'labels' => $results->pluck('day')->toArray(),
            'values' => $results->pluck('value')->toArray(),
        ];
    }
}

<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PohodaInvoiceService
{
    /**
     * Jméno připojení k Pohoda DB (máš už v config/database.php)
     */
    private string $conn = 'sqlsrv_pohoda';

    /**
     * Tady si případně přepiš názvy tabulek/sloupců podle své Pohody.
     *
     * Typická struktura:
     *  - FAKTURA: ID, CISLODOKLADU, DATUM, ODBERATEL, STAV, CELKEM, DATSPLATNOSTI, DATUMZAPLACENI
     */
    private string $invoicesTable = 'FAKTURA';
    private string $idColumn = 'ID';
    private string $numberColumn = 'CISLODOKLADU';
    private string $dateColumn = 'DATUM';
    private string $customerColumn = 'ODBERATEL';
    private string $statusColumn = 'STAV';
    private string $totalColumn = 'CELKEM';
    private string $dueDateColumn = 'DATSPLATNOSTI';
    private string $paidDateColumn = 'DATUMZAPLACENI';

    /**
     * Vrátí seznam faktur s filtrem + stránkováním
     */
    public function getInvoices(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        $q = DB::connection($this->conn)
            ->table($this->invoicesTable)
            ->orderBy($this->dateColumn, 'desc');

        // Datum od
        if (!empty($filters['from'])) {
            $q->whereDate($this->dateColumn, '>=', $filters['from']);
        }

        // Datum do
        if (!empty($filters['to'])) {
            $q->whereDate($this->dateColumn, '<=', $filters['to']);
        }

        // Odběratel (fulltext-like)
        if (!empty($filters['customer'])) {
            $q->where($this->customerColumn, 'LIKE', '%' . $filters['customer'] . '%');
        }

        // Stav: paid / unpaid / overdue
        if (!empty($filters['status'])) {
            if ($filters['status'] === 'paid') {
                $q->whereNotNull($this->paidDateColumn);
            } elseif ($filters['status'] === 'unpaid') {
                $q->whereNull($this->paidDateColumn);
            } elseif ($filters['status'] === 'overdue') {
                $q->whereNull($this->paidDateColumn)
                    ->whereDate($this->dueDateColumn, '<', Carbon::today());
            }
        }

        return $q->paginate($perPage)->appends($filters);
    }

    /**
     * Statistiky panelu faktur (počty, sumy)
     */
    public function getStats(array $filters = []): array
    {
        $base = DB::connection($this->conn)
            ->table($this->invoicesTable);

        // stejné filtry jako v getInvoices, ale bez statusu
        if (!empty($filters['from'])) {
            $base->whereDate($this->dateColumn, '>=', $filters['from']);
        }
        if (!empty($filters['to'])) {
            $base->whereDate($this->dateColumn, '<=', $filters['to']);
        }
        if (!empty($filters['customer'])) {
            $base->where($this->customerColumn, 'LIKE', '%' . $filters['customer'] . '%');
        }

        // Klonování builderu
        $all = clone $base;
        $paid = clone $base;
        $unpaid = clone $base;
        $overdue = clone $base;

        $totalCount = $all->count();
        $totalSum = (float) $all->sum($this->totalColumn);

        $paidCount = $paid->whereNotNull($this->paidDateColumn)->count();
        $paidSum = (float) $paid->whereNotNull($this->paidDateColumn)->sum($this->totalColumn);

        $unpaidCount = $unpaid->whereNull($this->paidDateColumn)->count();
        $unpaidSum = (float) $unpaid->whereNull($this->paidDateColumn)->sum($this->totalColumn);

        $overdueCount = $overdue
            ->whereNull($this->paidDateColumn)
            ->whereDate($this->dueDateColumn, '<', Carbon::today())
            ->count();

        $overdueSum = (float) $overdue
            ->whereNull($this->paidDateColumn)
            ->whereDate($this->dueDateColumn, '<', Carbon::today())
            ->sum($this->totalColumn);

        return [
            'totalCount'   => $totalCount,
            'totalSum'     => $totalSum,
            'paidCount'    => $paidCount,
            'paidSum'      => $paidSum,
            'unpaidCount'  => $unpaidCount,
            'unpaidSum'    => $unpaidSum,
            'overdueCount' => $overdueCount,
            'overdueSum'   => $overdueSum,
        ];
    }

    /**
     * Data pro graf – obrat faktur po měsících
     */
    public function monthlyChart(int $months = 6): array
    {
        $from = Carbon::now()->startOfMonth()->subMonths($months - 1);

        $rows = DB::connection($this->conn)
            ->table($this->invoicesTable)
            ->selectRaw('FORMAT(' . $this->dateColumn . ', \'yyyy-MM\') as ym')
            ->selectRaw('SUM(' . $this->totalColumn . ') as total')
            ->whereDate($this->dateColumn, '>=', $from)
            ->groupBy('ym')
            ->orderBy('ym')
            ->get();

        return [
            'labels' => $rows->pluck('ym')->toArray(),
            'values' => $rows->pluck('total')->toArray(),
        ];
    }

    /**
     * TOP odběratelé podle obratu
     */
    public function topCustomers(int $limit = 5): Collection
    {
        return DB::connection($this->conn)
            ->table($this->invoicesTable)
            ->select([
                $this->customerColumn . ' as customer',
                DB::raw('COUNT(*) as invoices'),
                DB::raw('SUM(' . $this->totalColumn . ') as total'),
            ])
            ->groupBy($this->customerColumn)
            ->orderByDesc('total')
            ->limit($limit)
            ->get();
    }
}

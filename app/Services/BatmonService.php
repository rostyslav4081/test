<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class BatmonService
{
    /**
     * Základní informace o BRM zařízení z tabulky data_brmInfo + data_device.
     */
    public function getDeviceInfo(int $deviceId): ?object
    {
        return DB::connection('pgsql_monitor')
            ->table('data_brmInfo')
            ->join('data_device', 'data_brmInfo.deviceId', '=', 'data_device.id')
            ->where('data_brmInfo.deviceId', $deviceId)
            ->select('data_brmInfo.*', 'data_device.locationId')
            ->first();
    }

    /**
     * Měsíční součty Ah_chg / Ah_dischg z tabulky data_brmHistoryElmeter1h.
     * Odpovídá přibližně logice v BatmonPresenter::renderDetail().
     */
    public function getMonthlyElmHistory(int $deviceId, int $limit = 15): array
    {
        $rows = DB::connection('pgsql_monitor')
            ->table('data_brmHistoryElmeter1h')
            ->selectRaw("DISTINCT ON (date_trunc('day', \"timestamp\")) \"timestamp\", date_trunc('day', \"timestamp\") as timestamp_month, \"Ah_chg\", \"Ah_dischg\"")
            ->where('deviceId', $deviceId)
            ->orderByRaw('timestamp_month DESC')
            ->limit($limit)
            ->get()
            ->toArray();

        usort($rows, function ($a, $b) {
            return strcmp($a->timestamp_month, $b->timestamp_month);
        });

        return $rows;
    }
}

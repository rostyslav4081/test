<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RailChartService
{
    protected string $historyTable;
    protected int $deviceId;
    protected array $chartLines = [];
    protected ?int $noDataSplitSecs = null;

    public function startup(string $historyTable, int $deviceId, array $chartLines, ?int $noDataSplitSecs = null): void
    {
        $this->historyTable   = $historyTable;
        $this->deviceId       = $deviceId;
        $this->chartLines     = $chartLines;
        $this->noDataSplitSecs = $noDataSplitSecs;
    }

    /**
     * @param array $checkedLines  klíče polí z $chartLines
     * @param int   $startTimestamp unix
     * @param int   $endTimestamp   unix
     * @return array  data pro graf v podobném formátu, jak posílal původní RailChart
     */
    public function load(array $checkedLines, int $startTimestamp, int $endTimestamp): array
    {
        if (empty($checkedLines)) {
            return [];
        }

        // Mapování sérií
        $series = [];
        $seriesMap = [];

        foreach ($checkedLines as $index => $key) {
            if (!isset($this->chartLines[$key])) {
                continue;
            }

            [$label, $unit, $yAxisRight, $transform] = $this->chartLines[$key];

            $series[] = [
                'name'    => $label . ($unit ? " [$unit]" : ''),
                'yAxis'   => $yAxisRight ? 1 : 0,
                'data'    => [],
                'tooltip' => ['valueSuffix' => $unit ? " $unit" : ""],
            ];

            $seriesMap[$key] = count($series) - 1;
        }

        if (empty($series)) {
            return [];
        }

        $start = Carbon::createFromTimestamp($startTimestamp);
        $end   = Carbon::createFromTimestamp($endTimestamp);

        $query = DB::table($this->historyTable)
            ->where('deviceId', $this->deviceId)
            ->whereBetween('timestamp', [$start, $end])
            ->orderBy('timestamp');

        $rows = $query->get();

        if ($rows->isEmpty()) {
            return $series;
        }

        $startDbHistoryKey = 0;
        $lastTimestamp = null;

        foreach ($rows as $idx => $row) {
            $timestamp = Carbon::parse($row->timestamp)->timestamp;

            $missingData = false;
            if ($this->noDataSplitSecs !== null && $lastTimestamp !== null) {
                if (($timestamp - $lastTimestamp) > $this->noDataSplitSecs) {
                    $missingData = true;
                }
            }

            foreach ($seriesMap as $field => $serieIndex) {
                $val = $row->{$field} ?? null;
                [$label, $unit, $yAxisRight, $transform] = $this->chartLines[$field];

                if ($idx === $startDbHistoryKey) {
                    $series[$serieIndex]['data'][] = [
                        $startTimestamp * 1000,
                        null,
                    ];
                }

                if ($missingData) {
                    $series[$serieIndex]['data'][] = [
                        $timestamp * 1000,
                        null,
                    ];
                }

                if ($transform && is_callable($transform)) {
                    $val = $transform($val);
                }

                $series[$serieIndex]['data'][] = [
                    $timestamp * 1000,
                    $val,
                ];
            }

            $lastTimestamp = $timestamp;
        }

        // uzavírací NULL pro konec rozsahu
        foreach ($series as $serieIndex => $serie) {
            $series[$serieIndex]['data'][] = [
                $endTimestamp * 1000,
                null,
            ];
        }

        return $series;
    }
}

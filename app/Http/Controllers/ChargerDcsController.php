<?php

namespace App\Http\Controllers;

use App\Models\ChargerDcsDevice;
use App\Services\RailChartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChargerDcsController extends Controller
{
    protected RailChartService $railChart;

    public function __construct(RailChartService $railChart)
    {
        $this->railChart = $railChart;
    }

    /**
     * Seznam DCS nabíječek
     */
    public function index()
    {
        // Тут Eloquent — норм, проста таблиця
        $devices = ChargerDcsDevice::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->paginate(50);

        return view('charger_dcs.index', compact('devices'));
    }

    /**
     * Detail nabíječky + konfigurace grafu
     */
    public function show(int $id)
    {
        $device = ChargerDcsDevice::findOrFail($id);

        // Тут опис ліній для RailChart – аналог того, що ти маєш у ChargerDcsPresenter
        $chartLines = [
            "vehicleId"           => ["# vozidla", null, false, null],
            "Inab_w"              => ["Pož. proud od vozidla", null, false, null],
            "swi_loss"            => ["swi_loss", null, false, null],
            "swi_eff"             => ["swi_eff", null, false, null],
            "ucc_24v"             => ["Napětí +24V", "V", false, null],
            "pwr_nabijeni_250"    => ["Nabíjecí výkon", "kW", false, fn($v) => $v / 1000],
            "pwr_celkem_pohon"    => ["Celkový výkon pohonu", "kW", false, fn($v) => $v / 1000],
            "pwr_pomocne_pohony"  => ["Pomocné pohony", "kW", false, fn($v) => $v / 1000],
            "pwr_topeni"          => ["Výkon topení", "W", false, null],
            "vol_trolley"         => ["Napětí v troleji", "V", true, null],
            // ...додай інші поля так, як у твоєму оригінальному Presenter-і
        ];

        // фронтенд буде знати, які ключі можна відмічати
        return view('charger_dcs.show', [
            'device'     => $device,
            'chartLines' => $chartLines,
        ]);
    }

    /**
     * AJAX: vrací JSON data pro graf (history)
     */
    public function historyData(Request $request, int $id)
    {
        $device = ChargerDcsDevice::findOrFail($id);

        // очікувані параметри: checkedLines[], start, end (UNIX)
        $checkedLines   = (array) $request->get('checkedLines', []);
        $startTimestamp = (int) $request->get('start');
        $endTimestamp   = (int) $request->get('end');

        if (empty($checkedLines) || !$startTimestamp || !$endTimestamp) {
            return response()->json(['error' => 'Missing parameters'], 422);
        }

        // ті ж chart lines, що й у show()
        $chartLines = [
            "vehicleId"           => ["# vozidla", null, false, null],
            "Inab_w"              => ["Pož. proud od vozidla", null, false, null],
            "swi_loss"            => ["swi_loss", null, false, null],
            "swi_eff"             => ["swi_eff", null, false, null],
            "ucc_24v"             => ["Napětí +24V", "V", false, null],
            "pwr_nabijeni_250"    => ["Nabíjecí výkon", "kW", false, fn($v) => $v / 1000],
            "pwr_celkem_pohon"    => ["Celkový výkon pohonu", "kW", false, fn($v) => $v / 1000],
            "pwr_pomocne_pohony"  => ["Pomocné pohony", "kW", false, fn($v) => $v / 1000],
            "pwr_topeni"          => ["Výkon topení", "W", false, null],
            "vol_trolley"         => ["Napětí v troleji", "V", true, null],
        ];

        // Ініціалізація як у Nette: data_dcsHistory + deviceId
        $this->railChart->startup(
            historyTable: 'data_dcsHistory',   // зміни назву таблиці, якщо інша
            deviceId: $device->id,            // або інший стовпець, якщо треба
            chartLines: $chartLines,
            noDataSplitSecs: 300              // приклад: 5 min; адаптуй з оригіналу
        );

        $seriesData = $this->railChart->load(
            $checkedLines,
            $startTimestamp,
            $endTimestamp
        );

        return response()->json($seriesData);
    }
}

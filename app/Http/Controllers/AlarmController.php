<?php

namespace App\Http\Controllers;

use App\Services\AlarmService;

/**
 * @method void middleware($middleware)
 */
class AlarmController extends Controller
{
    public function __construct(
        private readonly AlarmService $service,
    ) {
        $this->middleware('auth');
    }

    public function show(int $deviceId)
    {
        $alarms = $this->service->getDeviceAlarms($deviceId);

        return view('alarm.show', [
            'deviceId' => $deviceId,
            'alarms'   => $alarms,
        ]);
    }
}

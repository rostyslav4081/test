<?php

namespace App\Http\Controllers;

use App\Services\RegulatorMbService;
class RegulatorMbController extends Controller
{
    public function __construct(
        private readonly RegulatorMbService $service,
    ) {
        $this->middleware('auth');
    }

public function show(int $deviceId)
{
    $info = $this->service->getInfo($deviceId);
    abort_if(!$info, 404);

    $history = $this->service->getHistory($deviceId);

    return view('regulator_mb.show', [
        'deviceId' => $deviceId,
        'info'     => $info,
        'history'  => $history,
    ]);
}

}

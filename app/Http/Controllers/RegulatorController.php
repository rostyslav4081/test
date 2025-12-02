<?php

namespace App\Http\Controllers;

use App\Services\RegulatorService;
class RegulatorController extends Controller
{
    public function __construct(
        private readonly RegulatorService $service,
    ) {
        $this->middleware('auth');
    }

public function show(int $deviceId)
{
    $info = $this->service->getInfo($deviceId);
    abort_if(!$info, 404);

    $history = $this->service->getHistory($deviceId);

    return view('regulator.show', [
        'deviceId' => $deviceId,
        'info'     => $info,
        'history'  => $history,
    ]);
}

}

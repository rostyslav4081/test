<?php

namespace App\Http\Controllers;

use App\Services\ChargerDcs19Service;
class ChargerDcs19Controller extends Controller
{
    public function __construct(
        private readonly ChargerDcs19Service $service,
    ) {
        $this->middleware('auth');
    }

public function show(int $deviceId)
{
    $info = $this->service->getInfo($deviceId);
    abort_if(!$info, 404);

    $history = $this->service->getHistory($deviceId);

    return view('charger_dcs19.show', [
        'deviceId' => $deviceId,
        'info'     => $info,
        'history'  => $history,
    ]);
}

}

<?php

namespace App\Http\Controllers;

use App\Services\ChargerAcs20Service;
class ChargerAcs20Controller extends Controller
{
    public function __construct(
        private readonly ChargerAcs20Service $service,
    ) {
        $this->middleware('auth');
    }

public function show(int $deviceId)
{
    $info = $this->service->getInfo($deviceId);
    abort_if(!$info, 404);

    $history = $this->service->getHistory($deviceId);

    return view('charger_acs20.show', [
        'deviceId' => $deviceId,
        'info'     => $info,
        'history'  => $history,
    ]);
}

}

<?php

namespace App\Http\Controllers;

use App\Services\ChargerRnsAcService;
class ChargerRnsAcController extends Controller
{
    public function __construct(
        private readonly ChargerRnsAcService $service,
    ) {
        $this->middleware('auth');
    }

public function show(int $deviceId)
{
    $info = $this->service->getInfo($deviceId);
    abort_if(!$info, 404);

    $history = $this->service->getHistory($deviceId);

    return view('charger_rns_ac.show', [
        'deviceId' => $deviceId,
        'info'     => $info,
        'history'  => $history,
    ]);
}

}

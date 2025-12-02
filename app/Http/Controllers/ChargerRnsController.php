<?php

namespace App\Http\Controllers;

use App\Services\ChargerRnsService;
class ChargerRnsController extends Controller
{
    public function __construct(
        private readonly ChargerRnsService $service,
    ) {
        $this->middleware('auth');
    }

public function show(int $deviceId)
{
    $info = $this->service->getInfo($deviceId);
    abort_if(!$info, 404);

    $history = $this->service->getHistory($deviceId);

    return view('charger_rns.show', [
        'deviceId' => $deviceId,
        'info'     => $info,
        'history'  => $history,
    ]);
}

}

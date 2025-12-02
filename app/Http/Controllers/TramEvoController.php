<?php

namespace App\Http\Controllers;

use App\Services\TramEvoService;
class TramEvoController extends Controller
{
    public function __construct(
        private readonly TramEvoService $service,
    ) {
        $this->middleware('auth');
    }

public function show(int $deviceId)
{
    $info = $this->service->getInfo($deviceId);
    abort_if(!$info, 404);

    $history = $this->service->getHistory($deviceId);

    return view('tram_evo.show', [
        'deviceId' => $deviceId,
        'info'     => $info,
        'history'  => $history,
    ]);
}

}

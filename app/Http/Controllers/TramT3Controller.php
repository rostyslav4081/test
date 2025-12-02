<?php

namespace App\Http\Controllers;

use App\Services\TramT3Service;
class TramT3Controller extends Controller
{
    public function __construct(
        private readonly TramT3Service $service,
    ) {
        $this->middleware('auth');
    }

public function show(int $deviceId)
{
    $info = $this->service->getInfo($deviceId);
    abort_if(!$info, 404);

    $history = $this->service->getHistory($deviceId);

    return view('tram_t3.show', [
        'deviceId' => $deviceId,
        'info'     => $info,
        'history'  => $history,
    ]);
}

}

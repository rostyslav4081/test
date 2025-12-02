<?php

namespace App\Http\Controllers;

use App\Services\TbusSorService;
class TbusSorController extends Controller
{
    public function __construct(
        private readonly TbusSorService $service,
    ) {
        $this->middleware('auth');
    }

public function show(int $deviceId)
{
    $info = $this->service->getInfo($deviceId);
    abort_if(!$info, 404);

    $history = $this->service->getHistory($deviceId);

    return view('tbus_sor.show', [
        'deviceId' => $deviceId,
        'info'     => $info,
        'history'  => $history,
    ]);
}

}

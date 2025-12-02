<?php

namespace App\Http\Controllers;

use App\Services\EbusSorService;
class EbusSorController extends Controller
{
    public function __construct(
        private readonly EbusSorService $service,
    ) {
        $this->middleware('auth');
    }

public function show(int $deviceId)
{
    $info = $this->service->getInfo($deviceId);
    abort_if(!$info, 404);

    $history = $this->service->getHistory($deviceId);

    return view('ebus_sor.show', [
        'deviceId' => $deviceId,
        'info'     => $info,
        'history'  => $history,
    ]);
}

}

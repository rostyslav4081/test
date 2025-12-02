<?php

namespace App\Http\Controllers;

use App\Services\BatmonService;
class BatmonController extends Controller
{
    public function __construct(
        private readonly BatmonService $service,
    ) {
        $this->middleware('auth');
    }

public function show(int $deviceId)
{
    $info = $this->service->getDeviceInfo($deviceId);
    abort_if(!$info, 404);

    $monthly = $this->service->getMonthlyElmHistory($deviceId);

    return view('batmon.show', [
        'deviceId' => $deviceId,
        'info'     => $info,
        'monthly'  => $monthly,
    ]);
}

}

<?php

namespace App\Http\Controllers;

use App\Services\DeviceDashboardService;

class DeviceDashboardController extends Controller
{
    public function __construct(
        private readonly DeviceDashboardService $service
    ) {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.devices', [
            'counts'       => $this->service->counts(),
            'latestEvents' => $this->service->latestEvents(),
            'topErrors'    => $this->service->topErrorDevices(),
            'statusChart'  => $this->service->statusChart(),
            'deviceList'   => $this->service->deviceList(),
        ]);
    }
}

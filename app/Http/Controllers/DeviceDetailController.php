<?php

namespace App\Http\Controllers;

use App\Services\{
    DeviceService,
    SnmpService,
    DcsService,
    DeviceHistoryService
};

class DeviceDetailController extends Controller
{
    public function __construct(
        private DeviceService $devices,
        private SnmpService $snmp,
        private DcsService $dcs,
        private DeviceHistoryService $history,
    ) {
        $this->middleware('auth');
    }

    public function show(int $id)
    {
        $device = $this->devices->getDevice($id);

        return view('devices.detail', [
            'device'   => $device,
            'snmp'     => [
                'ping'      => $this->snmp->ping($device->ip),
                'uptime'    => $this->snmp->uptime($device->ip),
                'cpu'       => $this->snmp->cpu($device->ip),
                'ram'       => $this->snmp->ram($device->ip),
                'temp'      => $this->snmp->temperature($device->ip),
            ],
            'dcs' => [
                'latest'   => $this->dcs->getDcsData($id),
                'shutdowns'=> $this->dcs->getShutdownReasons($id),
                'dtc'      => $this->dcs->getDtcCodes($id),
            ],
            'alarms'  => $this->history->getAlarms($id),
            'events'  => $this->history->getEvents($id),
            'dcsGraph'=> $this->history->dcsHistoryGraph($id),
        ]);
    }
}

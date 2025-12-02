<?php

namespace App\Http\Controllers;

use App\Services\EventService;
class EventController extends Controller
{
    public function __construct(
        private readonly EventService $service,
    ) {
        $this->middleware('auth');
    }

public function index()
{
    $events = $this->service->latest(50);
    $stats  = $this->service->statsByType();

    return view('event.index', [
        'events' => $events,
        'stats'  => $stats,
    ]);
}

public function device(int $deviceId)
{
    $events = $this->service->forDevice($deviceId);

    return view('event.device', [
        'deviceId' => $deviceId,
        'events'   => $events,
    ]);
}

}

<?php

namespace App\Http\Controllers;

use App\Models\SysEvent;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private EventService $service;



    public function index(Request $request)
    {
        $filters = $request->only([
            'device',
            'event_code',
            'date_from',
            'date_to',
        ]);

        $events = $this->service->getPaginated($filters, 50);

        $eventCodes = SysEvent::query()
            ->select('event')
            ->distinct()
            ->orderBy('event')
            ->pluck('event')
            ->toArray();

        return view('event.index', [
            'events'     => $events,
            'eventCodes' => $eventCodes,
            'filters'    => $filters,
        ]);
    }

    public function show(int $deviceId, string $timestamp)
    {
        $event = $this->service->findOne($deviceId, $timestamp);

        return view('event.show', [
            'event' => $event,
        ]);
    }

    public function export(Request $request)
    {
        $filters = $request->only([
            'device',
            'event_code',
            'date_from',
            'date_to',
        ]);

        return $this->service->exportCsv($filters);
    }
}

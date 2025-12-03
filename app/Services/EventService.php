<?php

namespace App\Services;

use App\Models\SysEvent;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EventService
{
    public function getPaginated(array $filters, int $perPage = 50): LengthAwarePaginator
    {
        // force IDE to register scopeFilter()
        SysEvent::filter([]);

        return SysEvent::query()
            ->with(['device.location'])
            ->filter($filters)
            ->orderByDesc('timestamp')
            ->paginate($perPage)
            ->appends($filters);
    }

    public function findOne(int $deviceId, string $timestamp): SysEvent
    {
        // force IDE to register scopeFilter()
        SysEvent::filter([]);

        return SysEvent::query()
            ->with(['device.location'])
            ->where('deviceId', $deviceId)
            ->where('timestamp', $timestamp)
            ->firstOrFail();
    }

    public function exportCsv(array $filters): StreamedResponse
    {
        $fileName = 'events_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $callback = function () use ($filters) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'deviceId',
                'deviceName',
                'location',
                'timestamp',
                'eventCode',
                'eventText',
            ], ';');

            // force IDE to register scopeFilter()
            SysEvent::filter([]);

            SysEvent::query()
                ->with(['device.location'])
                ->filter($filters)
                ->orderByDesc('timestamp')
                ->chunk(500, function ($events) use ($handle) {
                    foreach ($events as $event) {

                        // force IDE to register accessor
                        $event->event_text;

                        $device   = $event->device;
                        $location = $device?->location;

                        fputcsv($handle, [
                            $event->deviceId,
                            $device->name ?? '',
                            $location->locName ?? $device->locDesc ?? '',
                            optional($event->timestamp)->format('Y-m-d H:i:s'),
                            $event->event,
                            $event->event_text,
                        ], ';');
                    }
                });

            fclose($handle);
        };

        return new StreamedResponse($callback, 200, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ]);
    }
}

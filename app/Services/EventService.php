<?php

namespace App\Services;

use App\Models\MonitorEvent;
use Illuminate\Support\Collection;

class EventService
{
    /**
     * Получить последние события
     */
    public function latest(int $limit = 20): Collection
    {
        return MonitorEvent::orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Поиск событий по типу, устройству или описанию
     */
    public function search(?string $term, int $limit = 50): Collection
    {
        if (!$term) {
            return collect();
        }

        $term = trim($term);

        return MonitorEvent::query()
            ->where('event_type', 'ILIKE', "%{$term}%")
            ->orWhere('description', 'ILIKE', "%{$term}%")
            ->orWhere('device_id', 'ILIKE', "%{$term}%")
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Пагинация событий
     */
    public function paginate(int $perPage = 50)
    {
        return MonitorEvent::orderByDesc('created_at')->paginate($perPage);
    }

    /**
     * Получить события конкретного устройства
     */
    public function forDevice(string $deviceId, int $limit = 50): Collection
    {
        return MonitorEvent::where('device_id', $deviceId)
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Получить статистику по типам событий
     */
    public function statsByType(): Collection
    {
        return MonitorEvent::selectRaw('event_type, count(*) as cnt')
            ->groupBy('event_type')
            ->orderByDesc('cnt')
            ->get();
    }
}

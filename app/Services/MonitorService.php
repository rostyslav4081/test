<?php

namespace App\Services;

use App\Models\MonitorEvent;

class MonitorService
{
    public function latestEvents(int $limit = 20)
    {
        return MonitorEvent::orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }
}


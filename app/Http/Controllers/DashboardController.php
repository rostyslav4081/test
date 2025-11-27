<?php

namespace App\Http\Controllers;

use App\Services\MonitorService;
use App\Services\PohodaService;

class DashboardController extends Controller
{
    public function index(MonitorService $monitor, PohodaService $pohoda)
    {
        $events = $monitor->latestEvents(10);
        $stock  = $pohoda->searchStock('Kabel');

        return view('dashboard.index', compact('events', 'stock'));
    }
}

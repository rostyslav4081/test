<?php

namespace App\Http\Controllers;

use App\Services\PohodaDashboardService;

class PohodaDashboardController extends Controller
{
    public function __construct(
        private readonly PohodaDashboardService $dashboard
    ) {}

    public function index()
    {
        return view('pohoda.dashboard', [
            'stockValue'  => $this->dashboard->stockValue(),
            'orders30'    => $this->dashboard->ordersCount(30),
            'sales30'     => $this->dashboard->salesTotal(30),
            'topProducts' => $this->dashboard->topProducts(10, 30),
            'lowStock'    => $this->dashboard->lowStock(5),
            'salesChart'  => $this->dashboard->salesChart(30),
            'stockChart'  => $this->dashboard->stockChart(),
        ]);
    }
}

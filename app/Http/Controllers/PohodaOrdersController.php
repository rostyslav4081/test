<?php

namespace App\Http\Controllers;

use App\Services\PohodaOrdersService;
use Illuminate\Http\Request;

class PohodaOrdersController extends Controller
{
    private PohodaOrdersService $service;

    public function __construct(PohodaOrdersService $service)
    {
        $this->service = $service;
    }

    // GET /pohoda/orders
    public function index(Request $request)
    {
        $orders = $this->service->getOrders($request->all(), 200);

        return view('pohoda.orders.index', [
            'orders' => $orders,
        ]);
    }

    // GET /pohoda/orders/{id}
    public function show(int $id)
    {
        $data = $this->service->getOrderWithItems($id);

        if (!$data) {
            abort(404, "Objednávka nenalezena.");
        }

        return view('pohoda.orders.show', [
            'order' => $data->order,
            'items' => $data->items,
        ]);
    }

    // GET /pohoda/orders/stats
    public function stats(Request $request)
    {
        $stats = $this->service->getOrdersStats(
            $request->get('from_date'),
            $request->get('to_date')
        );

        return response()->json($stats);
    }
}

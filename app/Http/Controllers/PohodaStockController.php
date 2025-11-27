<?php

namespace App\Http\Controllers;

use App\Services\PohodaStockService;
use Illuminate\Http\Request;

class PohodaStockController extends Controller
{
    public function __construct(
        private readonly PohodaStockService $stockService
    ) {}

    public function index(Request $request)
    {
        $filters = $request->only('search', 'warehouse');

        $items = $this->stockService->getStock($filters);

        $stats = $this->stockService->getStockStats();

        return view('pohoda.stock.index', compact('items', 'filters', 'stats'));
    }

    public function show(int $id)
    {
        $item = $this->stockService->getItem($id);

        if (!$item) {
            abort(404);
        }

        $movements = $this->stockService->getItemMovements($id);

        return view('pohoda.stock.show', compact('item', 'movements'));
    }
}

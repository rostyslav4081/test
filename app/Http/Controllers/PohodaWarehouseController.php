<?php

namespace App\Http\Controllers;

use App\Services\PohodaWarehouseService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class PohodaWarehouseController extends Controller
{
    private PohodaWarehouseService $service;

    public function __construct(PohodaWarehouseService $service)
    {
        $this->service = $service;
    }

    /**
     * Список skladových položek + фільтри.
     */
    public function index(Request $request): View
    {
        $filters = [
            'search'   => $request->input('search'),
            'min_qty'  => $request->input('min_qty'),
            'max_qty'  => $request->input('max_qty'),
            'warehouse'=> $request->input('warehouse'),
        ];

        $items = $this->service->getWarehouseItems($filters);

        return view('pohoda.stock.index', [
            'items'   => $items,
            'filters' => $filters,
        ]);
    }

    /**
     * Деталь однієї skladové položky.
     */
    public function show(int $id): View|Response
    {
        $item = $this->service->getItemById($id);

        if (!$item) {
            return response("Záznam nebyl nalezen", 404);
        }

        return view('pohoda.stock.show', [
            'item' => $item,
        ]);
    }
}

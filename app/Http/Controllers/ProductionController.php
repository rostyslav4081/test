<?php

namespace App\Http\Controllers;

use App\Services\ProductionService;
class ProductionController extends Controller
{
    public function __construct(
        private readonly ProductionService $service,
    ) {
        $this->middleware('auth');
    }

public function index()
{
    $items = $this->service->getAll();

    return view('production.index', [
        'items' => $items,
    ]);
}

public function show(int $id)
{
    $item = $this->service->find($id);
    abort_if(!$item, 404);

    return view('production.show', [
        'item' => $item,
    ]);
}

}

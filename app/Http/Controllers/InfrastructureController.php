<?php

namespace App\Http\Controllers;

use App\Services\InfrastructureService;
class InfrastructureController extends Controller
{
    public function __construct(
        private readonly InfrastructureService $service,
    ) {
        $this->middleware('auth');
    }

public function index()
{
    $items = $this->service->getAll();

    return view('infrastructure.index', [
        'items' => $items,
    ]);
}

public function show(int $id)
{
    $item = $this->service->find($id);
    abort_if(!$item, 404);

    return view('infrastructure.show', [
        'item' => $item,
    ]);
}

}

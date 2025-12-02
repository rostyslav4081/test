<?php

namespace App\Http\Controllers;

use App\Services\SoftwareService;
class SoftwareController extends Controller
{
    public function __construct(
        private readonly SoftwareService $service,
    ) {
        $this->middleware('auth');
    }

public function index()
{
    $items = $this->service->getAll();

    return view('software.index', [
        'items' => $items,
    ]);
}

public function show(int $id)
{
    $item = $this->service->find($id);
    abort_if(!$item, 404);

    return view('software.show', [
        'item' => $item,
    ]);
}

}

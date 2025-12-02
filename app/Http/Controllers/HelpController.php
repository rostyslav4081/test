<?php

namespace App\Http\Controllers;

use App\Services\HelpService;
class HelpController extends Controller
{
    public function __construct(
        private readonly HelpService $service,
    ) {
        $this->middleware('auth');
    }

public function index()
{
    $items = $this->service->getAll();

    return view('help.index', [
        'items' => $items,
    ]);
}

public function show(int $id)
{
    $item = $this->service->find($id);
    abort_if(!$item, 404);

    return view('help.show', [
        'item' => $item,
    ]);
}

}

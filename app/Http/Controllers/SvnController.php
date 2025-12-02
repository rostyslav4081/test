<?php

namespace App\Http\Controllers;

use App\Services\SvnService;
class SvnController extends Controller
{
    public function __construct(
        private readonly SvnService $service,
    ) {
        $this->middleware('auth');
    }

public function index()
{
    $items = $this->service->getAll();

    return view('svn.index', [
        'items' => $items,
    ]);
}

public function show(int $id)
{
    $item = $this->service->find($id);
    abort_if(!$item, 404);

    return view('svn.show', [
        'item' => $item,
    ]);
}

}

<?php

namespace App\Http\Controllers;

use App\Services\SettingsService;
class SettingsController extends Controller
{
    public function __construct(
        private readonly SettingsService $service,
    ) {
        $this->middleware('auth');
    }

public function index()
{
    $items = $this->service->getAll();

    return view('settings.index', [
        'items' => $items,
    ]);
}

public function show(int $id)
{
    $item = $this->service->find($id);
    abort_if(!$item, 404);

    return view('settings.show', [
        'item' => $item,
    ]);
}

}

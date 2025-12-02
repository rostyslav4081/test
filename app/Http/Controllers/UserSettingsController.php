<?php

namespace App\Http\Controllers;

use App\Services\UserSettingsService;
class UserSettingsController extends Controller
{
    public function __construct(
        private readonly UserSettingsService $service,
    ) {
        $this->middleware('auth');
    }

public function index()
{
    $items = $this->service->getAll();

    return view('user_settings.index', [
        'items' => $items,
    ]);
}

public function show(int $id)
{
    $item = $this->service->find($id);
    abort_if(!$item, 404);

    return view('user_settings.show', [
        'item' => $item,
    ]);
}

}

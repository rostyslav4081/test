<?php

namespace App\Http\Controllers;

use App\Services\AttendanceService;
class AttendanceController extends Controller
{
    public function __construct(
        private readonly AttendanceService $service,
    ) {
        $this->middleware('auth');
    }

public function index()
{
    $items = $this->service->getAll();

    return view('attendance.index', [
        'items' => $items,
    ]);
}

public function show(int $id)
{
    $item = $this->service->find($id);
    abort_if(!$item, 404);

    return view('attendance.show', [
        'item' => $item,
    ]);
}

}

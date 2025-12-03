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
        // $id – це порядковий номер у списку (1,2,3...)
        $item = $this->service->findByIndex($id);

        return view('attendance.show', [
            'id'   => $id,
            'item' => $item,
        ]);
    }
}

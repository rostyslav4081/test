<?php

namespace App\Http\Controllers;

use App\Models\WarehouseItem;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $items = WarehouseItem::orderBy('name')->paginate(50);
        $q = null;

        return view('warehouse.index', compact('items', 'q'));
    }

    public function search(Request $request)
    {
        $q = $request->get('q');

        $items = WarehouseItem::query()
            ->when($q, function ($query, $q) {
                $q = trim($q);
                $query->where('code', 'LIKE', "%{$q}%")
                    ->orWhere('name', 'LIKE', "%{$q}%")
                    ->orWhere('location', 'LIKE', "%{$q}%");
            })
            ->orderBy('name')
            ->paginate(50)
            ->appends(['q' => $q]);

        return view('warehouse.index', compact('items', 'q'));
    }
}

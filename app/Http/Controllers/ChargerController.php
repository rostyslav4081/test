<?php

namespace App\Http\Controllers;

use App\Services\ChargerService;
class ChargerController extends Controller
{
    public function __construct(
        private readonly ChargerService $service,
    ) {
        $this->middleware('auth');
    }

public function index()
{
    return view('charger.index');
}

}

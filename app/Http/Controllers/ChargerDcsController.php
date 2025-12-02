<?php

namespace App\Http\Controllers;

use App\Services\ChargerDcsService;
class ChargerDcsController extends Controller
{
    public function __construct(
        private readonly ChargerDcsService $service,
    ) {
        $this->middleware('auth');
    }

public function index()
{
    return view('charger_dcs.index');
}

}

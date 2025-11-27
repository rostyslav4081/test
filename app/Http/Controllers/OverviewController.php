<?php

namespace App\Http\Controllers;

class OverviewController extends Controller
{
    public function index()
    {
        // Zde můžeš později doplnit logiku z OverviewPresenter
        return view('overview.index');
    }
}

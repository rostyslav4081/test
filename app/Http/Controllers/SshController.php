<?php

namespace App\Http\Controllers;

use App\Services\SshService;
class SshController extends Controller
{
    public function __construct(
        private readonly SshService $service,
    ) {
        $this->middleware('auth');
    }

public function index()
{
    return view('ssh.index');
}

}

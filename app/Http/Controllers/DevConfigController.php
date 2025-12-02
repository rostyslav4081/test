<?php

namespace App\Http\Controllers;

use App\Services\DevConfigService;
use Illuminate\Http\Request;
class DevConfigController extends Controller
{
    public function __construct(
        private readonly DevConfigService $service,
    ) {
        $this->middleware('auth');
    }

public function index()
{
    $configs = $this->service->all();

    return view('dev_config.index', [
        'configs' => $configs,
    ]);
}

public function edit(string $deviceId)
{
    $config = $this->service->get($deviceId);

    return view('dev_config.edit', [
        'deviceId' => $deviceId,
        'config'   => $config,
    ]);
}

public function update(Request $request, string $deviceId)
{
    $this->service->save($deviceId, $request->all());

    return redirect()
        ->back()
        ->with('status', 'Configuration saved.');
}

}

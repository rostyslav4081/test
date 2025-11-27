<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\DeviceDetailController;
use App\Http\Controllers\PohodaOrdersController;
use App\Http\Controllers\PohodaWarehouseController;
use App\Http\Controllers\PohodaDashboardController;
use App\Http\Controllers\ChargerDcsController;

// --------------------------
// LOGIN
// --------------------------

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --------------------------
// CHRÁNĚNÉ ROUTY
// --------------------------

Route::middleware(['auth'])->group(function () {

    // --------------------------
    // MAIN DASHBOARD (původnÃ­ OverviewPresenter)
    // --------------------------
    Route::get('/', [OverviewController::class, 'index'])->name('overview.index');

    // --------------------------
    // DEVICE DETAIL (včetně SNMP, DCS, EVENTS, ALARMS)
    // --------------------------
    Route::prefix('device')->group(function () {

        Route::get('/{id}', [DeviceDetailController::class, 'show'])
            ->name('device.detail');

        Route::get('/{id}/snmp', [DeviceDetailController::class, 'snmp'])
            ->name('device.snmp');

        Route::get('/{id}/dcs', [DeviceDetailController::class, 'dcs'])
            ->name('device.dcs');

        Route::get('/{id}/events', [DeviceDetailController::class, 'events'])
            ->name('device.events');

        Route::get('/{id}/alarms', [DeviceDetailController::class, 'alarms'])
            ->name('device.alarms');
    });

    // --------------------------
    // POHODA – OBJEDNÁVKY
    // --------------------------
    Route::prefix('pohoda')->group(function () {

        // Список замовлень

        Route::get('/orders', [PohodaOrdersController::class, 'index'])
            ->name('pohoda.orders.index');

        // Детальний перегляд замовлення
        Route::get('/orders/{id}', [PohodaOrdersController::class, 'show'])
            ->name('pohoda.orders.show');

        // Статистика замовлень
        Route::get('/orders/stats', [PohodaOrdersController::class, 'stats'])
            ->name('pohoda.orders.stats');
    });

    // --------------------------
    // POHODA SKLAD
    // --------------------------
    Route::prefix('pohoda/warehouse')->group(function () {

        Route::get('/', [PohodaWarehouseController::class, 'index'])
            ->name('pohoda.warehouse.index');

        Route::get('/{id}', [PohodaWarehouseController::class, 'show'])
            ->name('pohoda.warehouse.show');
    });

    // --------------------------
    // POHODA DASHBOARD (grafy, statistiky)
    // --------------------------
    Route::get('/pohoda/dashboard', [PohodaDashboardController::class, 'index'])
        ->name('pohoda.dashboard.index');

    // Charger DCS
    Route::get('/charger-dcs', [ChargerDcsController::class, 'index'])->name('charger_dcs.index');
    Route::get('/charger-dcs/{id}', [ChargerDcsController::class, 'show'])->name('charger_dcs.show');
    Route::get('/charger-dcs/{id}/history-data', [ChargerDcsController::class, 'historyData'])->name('charger_dcs.history_data');
});

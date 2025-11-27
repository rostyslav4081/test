<?php

namespace App\Providers;

use App\Services\AlarmService;
use App\Services\ChargerDcsService;
use App\Services\ChargerService;
use App\Services\DevConfigService;
use App\Services\EventService;
use App\Services\InfrastructureService;
use App\Services\PohodaOrdersService;
use App\Services\PohodaService;
use App\Services\RailChartService;
use App\Services\SnmpService;
use App\Services\SshService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(\App\Services\MonitorService::class, function () {
            return new \App\Services\MonitorService();
        });

        $this->app->singleton(\App\Services\PohodaService::class, function () {
            return new \App\Services\PohodaService();
        });
        $this->app->singleton(\App\Services\EventService::class, function () {
            return new \App\Services\EventService();
        });
        $this->app->singleton(RailChartService::class, function () { return new RailChartService(); });
        $this->app->singleton(SshService::class, function () { return new SshService(); });
        $this->app->singleton(ChargerDcsService::class, function () { return new ChargerDcsService(); });
        $this->app->singleton(ChargerService::class, function () { return new ChargerService(); });
        $this->app->singleton(InfrastructureService::class, function () { return new InfrastructureService(); });
        $this->app->singleton(PohodaService::class, function () { return new PohodaService(); });
        $this->app->singleton(PohodaOrdersService::class, function () { return new PohodaOrdersService(); });
        $this->app->singleton(SnmpService::class, function () { return new SnmpService(); });
        $this->app->singleton(AlarmService::class, function () { return new AlarmService(); });
        $this->app->singleton(DevConfigService::class, function () { return new DevConfigService(); });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

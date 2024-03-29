<?php

namespace App\Providers;

use App\DataTables\agendaDataTable;
use App\Http\Controllers\API\DataTableController;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Services\DataTable;
use NascentAfrica\Jetstrap\JetstrapFacade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(DataTableController::class)->needs(DataTable::class)->give(function () {
            $className = request()->query('class');

            if (class_exists($className)) {
                return (new $className);
            }

            return abort(403);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JetstrapFacade::useAdminLte3();
    }
}

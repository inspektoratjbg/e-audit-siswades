<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AnggaranServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        require_once app_path() . '/Helpers/Anggaran.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

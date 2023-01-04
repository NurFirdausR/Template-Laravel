<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\t_notifikasi;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id');
    }
}

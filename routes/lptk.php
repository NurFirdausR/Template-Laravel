<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LPTK\{
    DashboardController,
};

Route::group([
    'prefix' => 'lptk',
    'middleware' => 'role:lptk',
    'as' => 'lptk.'
], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

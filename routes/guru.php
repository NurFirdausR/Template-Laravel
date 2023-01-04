<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Guru\{
    DashboardController,
};

Route::group([
    'prefix' => 'guru',
    'middleware' => 'role:guru',
    'as' => 'guru.'
], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

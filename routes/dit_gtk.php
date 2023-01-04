<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DitGTK\{
    DashboardController,
};

Route::group([
    'prefix' => 'dit_gtk',
    'middleware' => 'role:dit_gtk',
    'as' => 'dit_gtk.'
], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

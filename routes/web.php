<?php

use App\Http\Controllers\PortfolioController;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'portfolios' => Portfolio::query()->latest('year')->latest('id')->get(),
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('portfolios', PortfolioController::class)->except('show');
});

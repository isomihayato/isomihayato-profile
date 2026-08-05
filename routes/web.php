<?php

use App\Http\Controllers\ExperiencedTechnologyController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TechnologyFieldController;
use App\Models\Portfolio;
use App\Models\TechnologyField;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'portfolios' => Portfolio::query()->latest('year')->latest('id')->get(),
        'technologyFields' => TechnologyField::query()->with('experiencedTechnologies')->orderBy('name')->get(),
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
    Route::resource('technology-fields', TechnologyFieldController::class)->except('show');
    Route::resource('experienced-technologies', ExperiencedTechnologyController::class)->except('show');
});

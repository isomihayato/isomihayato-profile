<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactInquiryController;
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
})->name('home');

Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');

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
    Route::get('contact-inquiries', [ContactInquiryController::class, 'index'])->name('contact-inquiries.index');
    Route::get('contact-inquiries/{contactInquiry}', [ContactInquiryController::class, 'show'])->name('contact-inquiries.show');
    Route::post('contact-inquiries/{contactInquiry}/reply', [ContactInquiryController::class, 'reply'])->name('contact-inquiries.reply');
    Route::delete('contact-inquiries/{contactInquiry}', [ContactInquiryController::class, 'destroy'])->name('contact-inquiries.destroy');
});

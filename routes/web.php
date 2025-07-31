<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/donations/{donation}/pdf', [\App\Http\Controllers\DonationPdfController::class, 'generate'])->name('donations.pdf');

Route::get('/donations/export', [\App\Http\Controllers\DonationExportController::class, 'export'])->name('donations.export');

Route::get('/services/print/all/{type}', [\App\Http\Controllers\ServicePdfController::class, 'printAll'])
    ->name('services.print.all');



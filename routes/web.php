<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class)->name('home');

Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements');

Route::post('/announcement/view/{id}', [AnnouncementController::class, 'incrementView'])->name('announcements.increment-view');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/cabang', [CabangController::class, 'index'])->name('cabang');

Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi');

Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/donations/{donation}/pdf', [\App\Http\Controllers\DonationPdfController::class, 'generate'])->name('donations.pdf');

Route::get('/donations/export', [\App\Http\Controllers\DonationExportController::class, 'export'])->name('donations.export');

Route::get('/services/print/all/{type}', [\App\Http\Controllers\ServicePdfController::class, 'printAll'])
    ->name('services.print.all');

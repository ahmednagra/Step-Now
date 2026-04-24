<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;


// Frontend routes
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/about-us', [FrontController::class, 'aboutUs'])->name('front.about');
Route::get('/contact-us', [FrontController::class, 'contactUs'])->name('front.contactus');
Route::post('/contact-us-store', [FrontController::class, 'contactUsStore'])->name('front.contactus.store');
Route::post('/booking-store', [FrontController::class, 'bookingStore'])->name('front.booking.store');
Route::get('/services', [FrontController::class, 'services'])->name('front.services');
Route::get('/service/{slug}', [FrontController::class, 'serviceDetail'])->name('front.service.detail');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('front.pricing');
Route::get('/rent-now/{id}', [FrontController::class, 'rentNow'])->name('front.rentnow');
Route::get('/gallery', [FrontController::class, 'gallery'])->name('front.gallery');
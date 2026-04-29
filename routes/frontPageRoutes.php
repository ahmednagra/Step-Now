<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\PolicyController;
use App\Http\Controllers\Front\NewsletterController;

/*
 |--------------------------------------------------------------------------
 | Frontend Routes
 |--------------------------------------------------------------------------
 |
 | Public-facing routes for step-now.de.
 |
 | Notes:
 |  - Throttle middleware is applied to all public POST endpoints
 |    (booking, contact, newsletter) to mitigate spam / abuse, which is
 |    one of the technische und organisatorische Maßnahmen required by
 |    Art. 32 DSGVO. Limit: 5 requests per minute per IP.
 |  - The five legal pages (Impressum, Datenschutz, AGB, Widerruf, Cookies)
 |    are served from the `policies` table via PolicyController. They
 |    must remain reachable in <= 2 clicks from every page (BGH 2-Klick-
 |    Regel) — see the footer template for the link block.
 */

// ----- Public pages ---------------------------------------------------------
Route::get('/',                  [FrontController::class, 'index'])->name('front.index');
Route::get('/about-us',          [FrontController::class, 'aboutUs'])->name('front.about');
Route::get('/contact-us',        [FrontController::class, 'contactUs'])->name('front.contactus');
Route::get('/services',          [FrontController::class, 'services'])->name('front.services');
Route::get('/service/{slug}',    [FrontController::class, 'serviceDetail'])->name('front.service.detail');
Route::get('/pricing',           [FrontController::class, 'pricing'])->name('front.pricing');
Route::get('/rent-now/{id}',     [FrontController::class, 'rentNow'])->name('front.rentnow');
Route::get('/gallery',           [FrontController::class, 'gallery'])->name('front.gallery');

// ----- Public POST endpoints (rate-limited) ---------------------------------
Route::middleware('throttle:5,1')->group(function () {
    Route::post('/contact-us-store', [FrontController::class, 'contactUsStore'])->name('front.contactus.store');
    Route::post('/booking-store',    [FrontController::class, 'bookingStore'])->name('front.booking.store');
    Route::post('/newsletter-store', [NewsletterController::class, 'store'])->name('front.newsletter.store');
});

// ----- Newsletter Double-Opt-In confirmation (signed URL) -------------------
Route::get('/newsletter/confirm/{token}', [NewsletterController::class, 'confirm'])
    ->name('front.newsletter.confirm');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])
    ->name('front.newsletter.unsubscribe');

// ----- Legal pages (DDG / DSGVO / TDDDG) ------------------------------------
// These are MANDATORY and must remain reachable from every page footer.
Route::get('/impressum',          [PolicyController::class, 'impressum'])->name('front.impressum');
Route::get('/datenschutz',        [PolicyController::class, 'datenschutz'])->name('front.datenschutz');
Route::get('/agb',                [PolicyController::class, 'agb'])->name('front.agb');
Route::get('/widerrufsbelehrung', [PolicyController::class, 'widerruf'])->name('front.widerruf');
Route::get('/cookie-richtlinie',  [PolicyController::class, 'cookies'])->name('front.cookies');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\PolicyController;
use App\Http\Controllers\Front\NewsletterController;
use App\Http\Controllers\Front\SitemapController;
use App\Http\Controllers\LocaleController;

/*
 |--------------------------------------------------------------------------
 | Frontend Routes
 |--------------------------------------------------------------------------
 |
 | Notes:
 |  - Throttle middleware on POST endpoints — Art. 32 DSGVO TOMs. 5/min/IP.
 |  - Five legal pages served from `policies` table via PolicyController.
 |    Bilingual: picks the EN column when locale=='en' AND it has content.
 |  - /locale/{lang} switches language and redirects back to Referer.
 |  - /sitemap.xml is served by SitemapController and includes hreflang
 |    alternates per URL.
 |  - Newsletter confirm/unsubscribe tokens are constrained to 64-char
 |    alphanumeric strings to keep route binding fast and obvious bot
 |    traffic out of the controller.
 */

// ----- Sitemap (no throttle, no auth — must be reachable for crawlers) -----
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('front.sitemap');

// ----- Locale switcher ------------------------------------------------------
Route::get('/locale/{lang}', [LocaleController::class, 'switch'])
    ->where('lang', 'de|en')
    ->name('locale.switch');

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

// ----- Newsletter Double-Opt-In (rate-limited per IP) ----------------------
Route::middleware('throttle:30,1')->group(function () {
    Route::get('/newsletter/confirm/{token}', [NewsletterController::class, 'confirm'])
        ->name('front.newsletter.confirm')
        ->where('token', '[A-Za-z0-9]{64}');

    Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])
        ->name('front.newsletter.unsubscribe')
        ->where('token', '[A-Za-z0-9]{64}');
});

// ----- Legal pages (DDG / DSGVO / TDDDG) — bilingual ------------------------
Route::get('/impressum',          [PolicyController::class, 'impressum'])->name('front.impressum');
Route::get('/datenschutz',        [PolicyController::class, 'datenschutz'])->name('front.datenschutz');
Route::get('/agb',                [PolicyController::class, 'agb'])->name('front.agb');
Route::get('/widerrufsbelehrung', [PolicyController::class, 'widerruf'])->name('front.widerruf');
Route::get('/cookie-richtlinie',  [PolicyController::class, 'cookies'])->name('front.cookies');

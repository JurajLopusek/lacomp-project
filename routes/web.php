<?php

use App\Http\Controllers\DeviceController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;

// REDIRECTS
Route::redirect('login', '/admin/login')->name('login');

// NO AUTH GROUP
Route::group([], static function () {
    Route::get('/', static function () {
        return view('pages.home');
    });

    Route::get('/alarmy', static function () {
        return view('pages.alarm');
    });

    Route::get('/kamery', static function () {
        return view('pages.cameras');
    });

    Route::get('/data.php', [DeviceController::class, 'store']);

    Route::get('/kontakt', static function () {
        return view('pages.contact');
    });
    Route::get('/kontakt', static function () {
        return view('pages.contact');
    })->name('kontakt');
    Route::get('/inspection', static function () {
        return view('pages.inspections');
    });
    Route::get('/photovoltaicSystems', static function () {
        return view('pages.photovoltaicSystems');
    });
    Route::get('/rekuperacie', static function () {
        return view('pages.rekuperacie');
    });
    Route::view('/rekuperacie/hrv', 'pages.hrv')->name('hrv');
    Route::view('/rekuperacie/erv', 'pages.erv')->name('erv');

    Route::get('/counter', Counter::class);
    Route::view('/privacy-policy', 'pages.privacy')->name('Privacy Policy');
    Route::view('/terms-of-service', 'pages.terms')->name('Terms of Service');

    Route::view('/about', 'pages.alarm')->name('alarm');
    Route::view('/contact', 'pages.contact')->name('contact');
    Route::view('/services', 'pages.cameras')->name('cameras');
});

// LOCAL DEV
if (App::environment('local')) {
    Route::get('/test', static function () {
        return view('test');
    });
}

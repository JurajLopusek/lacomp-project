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
        return view('welcome');
    });

    Route::get('/data.php', [DeviceController::class, 'store'])->httpOnly();

    Route::get('/kontakt', static function () {
        return view('pages.contact');
    });

    Route::get('/counter', Counter::class);
});

// LOCAL DEV
if (App::environment('local')) {
    Route::get('/test', static function () {
        return view('test');
    });
}

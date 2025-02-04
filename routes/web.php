<?php

use App\Http\Controllers\EnergyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/alarmy', function () {
    return view('pages.alarm');
});

Route::get('/kamery', function () {
    return view('welcome');
});

Route::get('/meranie_spotreby', function () {
    return view('pages.meranie_spotreby');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/meranie_spotreby', [EnergyController::class, 'storeData']);

Route::get('/kontakt', function () {
    return view('pages.contact');
});

use App\Livewire\Counter;

Route::get('/counter', Counter::class);

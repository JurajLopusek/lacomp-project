<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/alarmy', function () {
    return view('welcome');
});

Route::get('/kamery', function () {
    return view('welcome');
});

Route::get('/meranie_spotreby', function () {
    return view('welcome');
});


Route::get('/kontakt', function () {
    return view('pages.contact');
});

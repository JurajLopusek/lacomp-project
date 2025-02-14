<?php

use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;

Route::get('/measurement', [DeviceController::class, 'store']);

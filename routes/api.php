<?php

use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;

Route::post('/measurement', [DeviceController::class, 'store']);

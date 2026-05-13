<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/settings', [SettingsController::class, 'index']);

Route::post('/settings', [SettingsController::class, 'store']);

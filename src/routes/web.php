<?php

namespace Leolopez\Routes;

use Leolopez\Loginsv\Http\Controllers\LoginSvController;
use Illuminate\Support\Facades\Route;

Route::get('/redirectToProvider', [LoginSvController::class, 'redirectToProvider']);
Route::get('/callback', [LoginSvController::class, 'handleProviderCallback']);
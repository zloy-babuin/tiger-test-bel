<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\ProxyController;


Route::get('{action}', [ProxyController::class, 'runAction']);



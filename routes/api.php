<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//use App\Http\Controllers\Api\TestController;
//Route::get('/test', [TestController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



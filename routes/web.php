<?php

use Illuminate\Support\Facades\Route;

//Esto evitará que Laravel intente buscar rutas que deben manejarse en el frontend
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

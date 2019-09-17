<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Creo las rutas para Tarea y Distribuidor para el cliente que consuma la API

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('tarea', 'TareaController');
    Route::resource('distribuidor', 'DistribuidorController');
});



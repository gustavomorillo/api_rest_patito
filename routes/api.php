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



// Creacion de las rutas para Tarea y Distribuidor para el consumo de la API

// Se asignan 2 middleware:
// 1. Uno para la autenticacion mediante API Token
// 2. Uno para validar que el Distribuidor consuma la API de 8am a 5pm

Route::group(['middleware' => ['auth:api', 'checkTime']], function () {
    Route::resource('tarea', 'TareaController');
    Route::resource('distribuidor', 'DistribuidorController');
    
});
Route::post('login', 'DistribuidorController@login')->middleware('checkTime');

Route::post('asignacion', 'DistribuidorController@DistribuidorTareasXDia')->middleware('checkTime');



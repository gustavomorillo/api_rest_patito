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


// Creacion de las rutas para Tarea y Distribuidor para el consumo de la API

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('tarea', 'TareaController');
    Route::resource('distribuidor', 'DistribuidorController');
    
});
Route::post('login', 'DistribuidorController@login');


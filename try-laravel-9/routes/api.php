<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/prueba')->group(function () {


    // Route::get('/user/{id}', [UserController::class, 'show']);

    Route::post('registrar-contrato', 'App\Http\Controllers\ContractController@store');
    Route::get('listar-contrato', 'App\Http\Controllers\ContractController@index');
    Route::put('actualizar-contrato/{id}', 'App\Http\Controllers\ContractController@update');
    Route::delete('eliminar-contrato/{id}', 'App\Http\Controllers\ContractController@destroy');


    Route::post('registrar-trabajador', 'App\Http\Controllers\WorkerController@store');
    Route::get('listar-trabajador', 'App\Http\Controllers\WorkerController@index');
    Route::get('traer-trabajador/{id} ', 'App\Http\Controllers\WorkerController@show');
    Route::put('actualizar-trabajador/{id}', 'App\Http\Controllers\WorkerController@update');
    Route::delete('eliminar-trabajador/{id}', 'App\Http\Controllers\WorkerController@destroy');

    Route::get('generate-pdf', 'App\Http\Controllers\WorkerController@generatePDF');
});

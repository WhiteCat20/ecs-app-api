<?php

use App\Http\Controllers\AbsenAgendaController;
use App\Http\Controllers\AbsenPiketController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\TemperatureController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', LoginController::class)->name('login');
Route::post('/logout', LogoutController::class)->name('logout');

Route::middleware('auth:api')->get('/datauser', function (Request $request) {
    return $request->user();
});

Route::get('/agendas', [AgendaController::class, 'index']);
Route::get('/agendas-all', [AgendaController::class, 'indexAll']);
Route::get('/get-last-two-agendas', [AgendaController::class, 'getLastTwoAgenda']);
Route::post('/agendas', [AgendaController::class, 'store']);
Route::get('/agendas/{id}', [AgendaController::class, 'indexOne']);
Route::put('/agendas/{id}', [AgendaController::class, 'update']);
Route::delete('/agendas/{id}', [AgendaController::class, 'delete']);

Route::get('/absen-piket', [AbsenPiketController::class, 'index']);
Route::post('/absen-piket', [AbsenPiketController::class, 'store']);
Route::delete('/absen-piket/{id}', [AbsenPiketController::class, 'delete']);
Route::get('/absen-agenda', [AbsenAgendaController::class, 'index']);
Route::post('/absen-agenda', [AbsenAgendaController::class, 'store']);


//Generate Random Number
Route::get('/random-number', [AbsenPiketController::class, 'randomNumber']);

//Temperature Data 
Route::post('/temperature', TemperatureController::class);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\ClienteController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('examenes', [ExamenController::class, 'index']);
Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/clientes/{cliente_id}', [ClienteController::class, 'show']);
Route::get('/clientes/{cliente_id}/solicitudes', [ClienteController::class, 'listarSolicitudes']);
Route::get('/clientes/{cliente_id}/solicitudes/{solicitud_id}', [ClienteController::class, 'verSolicitud']);

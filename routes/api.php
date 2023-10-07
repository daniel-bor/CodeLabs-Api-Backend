<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\TipoSoporteController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Utilidades de Interfaz
Route::get('/soportes', [TipoSoporteController::class, 'index']);
Route::get('/examenes', [ExamenController::class, 'index']);

//Clientes
Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/clientes/{cliente_id}', [ClienteController::class, 'show']);
Route::get('/clientes/{cliente_id}/solicitudes', [ClienteController::class, 'listarSolicitudes']);
Route::get('/clientes/{cliente_id}/solicitudes/{solicitud_id}', [ClienteController::class, 'verSolicitud']);

//Solicitudes
Route::post('/solicitudes', [SolicitudController::class, 'store']);
Route::get('/solicitudes', [SolicitudController::class, 'index']);

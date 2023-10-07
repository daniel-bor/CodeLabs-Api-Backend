<?php

use App\Http\Controllers\AuthController;
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

//Registro de usuarios
Route::post('register', [AuthController::class, 'register']);
//Login
// Ruta para el inicio de sesión (login)
Route::post('login', [AuthController::class, 'login']);
// Ruta para el cierre de sesión (logout)
Route::post('logout', [AuthController::class, 'logout']);

//Utilidades de Interfaz
Route::middleware('jwt.auth')->get('/soportes', [TipoSoporteController::class, 'index']);
Route::get('/examenes', [ExamenController::class, 'index']);

//Clientes
Route::middleware('jwt.auth')->get('/clientes', [ClienteController::class, 'index']);
Route::middleware('jwt.auth')->get('/clientes/{cliente_id}', [ClienteController::class, 'show']);
Route::middleware('jwt.auth')->get('/clientes/{cliente_id}/solicitudes', [ClienteController::class, 'listarSolicitudes']);
Route::middleware('jwt.auth')->get('/clientes/{cliente_id}/solicitudes/{solicitud_id}', [ClienteController::class, 'verSolicitud']);

//Solicitudes
Route::middleware('jwt.auth')->post('/solicitudes', [SolicitudController::class, 'store']);
Route::middleware('jwt.auth')->get('/solicitudes', [SolicitudController::class, 'index']);
Route::middleware('jwt.auth')->get('/solicitudes/{solicitud_id}/detalle', [SolicitudController::class, 'getDetalle']);

<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MuestraController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\TipoSoporteController;
use App\Models\Muestra;
use App\Models\UnidadMedida;

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
Route::get('/clientes/nit/{nit}', [ClienteController::class, 'getDataClientNit']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->get('/clientes', [ClienteController::class, 'index']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->get('/clientes/expediente/{cliente_id}', [ClienteController::class, 'getExpediente']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->get('/clientes/{cliente_id}', [ClienteController::class, 'show']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->get('/clientes/{cliente_id}/solicitudes', [ClienteController::class, 'listarSolicitudes']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->get('/clientes/{cliente_id}/solicitudes/{solicitud_id}', [ClienteController::class, 'verSolicitud']);

//Solicitudes
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->get('/solicitudes', [SolicitudController::class, 'index']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->post('/solicitudes', [SolicitudController::class, 'store']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->patch('/solicitudes/{solicitud_id}/asignacion', [SolicitudController::class, 'assignToRole']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->delete('/solicitudes/{solicitud_id}', [SolicitudController::class, 'deleteById']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->get('/solicitudes/detalle/items/{solicitud_id}', [SolicitudController::class, 'getItems']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->get('/solicitudes/detalle/general/{solicitud_id}', [SolicitudController::class, 'getDetalleById']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->get('/solicitudes/detalle/muestras/{solicitud_id}', [SolicitudController::class, 'getMuestras']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->get('/solicitudes/trazabilidad/{solicitud_id}', [SolicitudController::class, 'getTrazabilidad']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->get('/solicitudes/estados', [SolicitudController::class, 'getEstados']);

//Muestras
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->post('/muestras', [MuestraController::class, 'store']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->post('/muestras/items', [MuestraController::class, 'asociarItems']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->get('/muestras/tipos/{tipo_muestra_id}/recipientes', [MuestraController::class, 'getRecipientesTipoMuestra']);
Route::middleware('jwt.auth', 'hasRole:Administrador,Analista,Asignador,Revisor')->delete('/muestras/{muestra_id}', [MuestraController::class, 'deleteById']);
Route::middleware('jwt.auth')->get('/muestras/tipos', [MuestraController::class, 'getTiposMuestras']);
Route::get('/muestras/detalle/{muestra_id}', [MuestraController::class, 'getDetalleById']);

//Unidad de medida:
Route::middleware('jwt.auth')->get('/medidas', [MuestraController::class, 'getUnidadesMedida']);

//TEST GRUPO 4
Route::get('/solicitudes/test', [SolicitudController::class, 'index']);

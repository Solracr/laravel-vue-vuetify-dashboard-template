<?php

use Illuminate\Http\Request;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\RequisitoController;

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
Auth::routes();
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::get('bandeja/fetchall', [BandejaController::class, 'fetchall'])->middleware('auth');
Route::post('solicitud/store',[SolicitudController::class,'store'])->middleware('auth');
Route::get('solicitud/bandeja',[SolicitudController::class,'index'])->middleware('auth');
Route::get('solicitud/nacionalidades',[SolicitudController::class,'nacionalidades'])->middleware('auth');
Route::get('solicitud/departamentos',[SolicitudController::class,'departamentos'])->middleware('auth');
Route::put('solicitud/municipios',[SolicitudController::class,'municipios'])->middleware('auth');
Route::get('solicitud/idiomas',[SolicitudController::class,'idiomas'])->middleware('auth');


Route::get('requisito/files',[RequisitoController::class,'index'])->middleware('auth');
Route::post('requisito/upload',[RequisitoController::class,'upload'])->middleware('auth');

Route::get('listadoEmpresas',[EmpresaController::class, 'listadoEmpresas'])->middleware('auth');
Route::get('consultarNit',[EmpresaController::class, 'webserviceSat'])->middleware('auth');
Route::post('registrarEmpresa',[EmpresaController::class, 'registrarEmpresa'])->middleware('auth');

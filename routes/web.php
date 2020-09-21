<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\UnidadMedidasController;
use App\Http\Controllers\RegistroMateriaPrimaController;
use App\Http\Controllers\MateriaPrimaProveedorController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('MateriaPrima', [RegistroMateriaPrimaController::class, 'store']);
Route::post('Usuarios', [UsuarioController::class, 'store']);
Route::post('MateriaPrimaProveedor', [MateriaPrimaProveedorController::class, 'store']);
Route::post('Pedido',[PedidoController::class, 'store']);
Route::get('Roles', [RolController::class,'index']);
Route::get('Usuarios', [UsuarioController::class,'index']);
Route::get('MateriaPrima', [RegistroMateriaPrimaController::class,'index']);
Route::get('MateriaPrimaProveedor', [MateriaPrimaProveedorController::class,'index']);
Route::get('UnidadMateria', [UnidadMedidasController::class,'index']);
Route::get('ProveedorMateria',[ProveedoresController::class,'index']);
Route::get('Pedido',[PedidoController::class,'index']);
Route::put('Pedido/{IdPedido}', [PedidoController::class,'update']);



// Route::put('MateriaPrima', [RegistroMateriaPrimaController::class, 'update']);
// Route::delete('MateriaPrima', [RegistroMateriaPrimaController::class, 'destroy']);



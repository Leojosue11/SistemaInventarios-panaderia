<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\UnidadMedidasController;
use App\Http\Controllers\RegistroMateriaPrimaController;
use App\Http\Controllers\MateriaPrimaProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\BodegaController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MovimientosMPController;
use App\Http\Controllers\SucursalController;

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
Route::get('Bodegas',[BodegaController::class,'index']);
Route::post('Pedido',[PedidoController::class, 'store']);
Route::get('Roles', [RolController::class,'index']);
Route::get('Usuarios', [UsuarioController::class,'index']);
Route::get('UnidadMateria', [UnidadMedidasController::class,'index']);
Route::get('Proveedores',[ProveedoresController::class,'index']);

Route::get('Productos',[ProductoController::class,'index']);
Route::get('MateriaPrima', [RegistroMateriaPrimaController::class,'index']);
//Metodo para traer Materia Prima
Route::get('ShowMateriaPrima',[RegistroMateriaPrimaController::class,'ShowMateriaPrima']);
Route::get('MateriaPrimaProveedor', [MateriaPrimaProveedorController::class,'index']);
Route::post('MateriaPrimaProveedor/{IDMatPrimaProveedor}', [MateriaPrimaProveedorController::class,'update']);
Route::get('Pedido',[PedidoController::class,'index']);
Route::post('Pedido/{IdPedido}', [PedidoController::class,'update']);
Route::get('MovimientoMP',[MovimientosMPController::class,'index']);
Route::post('MovimientoMP',[MovimientosMPController::class,'store']);
Route::get('Sucursal', [SucursalController::class,'index']);
Route::get('Inventario', [InventarioController::class,'index']);
Route::post('login', [UsuarioController::class,'login']);
Route::get('logout', [UsuarioController::class,'logout']);



// Route::put('MateriaPrima', [RegistroMateriaPrimaController::class, 'update']);
// Route::delete('MateriaPrima', [RegistroMateriaPrimaController::class, 'destroy']);



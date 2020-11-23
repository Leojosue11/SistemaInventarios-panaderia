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
use App\Http\Controllers\TipoProveedorController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\TituloController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\EncargadoController;

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
//Proveedores
Route::get('Proveedores',[ProveedoresController::class,'index']);
Route::post('Proveedores',[ProveedoresController::class,'store']);
Route::post('Proveedores/{IdProveedor}', [ProveedoresController::class,'destroy']);
Route::get('ListaProveedores',[ProveedoresController::class,'show']);

Route::get('Productos',[ProductoController::class,'index']);
Route::get('MateriaPrima', [RegistroMateriaPrimaController::class,'index']);
Route::get('Encargados', [EncargadoController::class,'index']);
//Metodo para traer Materia Prima
Route::get('ShowMateriaPrima',[RegistroMateriaPrimaController::class,'ShowMateriaPrima']);
Route::get('MateriaPrimaProveedor', [MateriaPrimaProveedorController::class,'index']);
Route::post('MateriaPrimaProveedor/{IDMatPrimaProveedor}', [MateriaPrimaProveedorController::class,'update']);
Route::post('AnularEntrada/{EntradaID}', [MateriaPrimaProveedorController::class,'destroy']);
Route::get('Pedido',[PedidoController::class,'index']);
Route::post('Pedido/{IdPedido}', [PedidoController::class,'update']);
Route::get('MovimientoMP',[MovimientosMPController::class,'index']);
Route::post('MovimientoMP',[MovimientosMPController::class,'store']);
Route::get('Sucursal', [SucursalController::class,'index']);
Route::get('Sucursales', [SucursalController::class,'show']);
Route::post('Sucursales', [SucursalController::class,'store']);
Route::post('Sucursales/{IdSucursal}', [SucursalController::class,'update']);

Route::get('Inventario', [InventarioController::class,'index']);
Route::post('login', [UsuarioController::class,'login']);
Route::get('logout', [UsuarioController::class,'logout']);
Route::get('TipoProveedor', [TipoProveedorController::class,'index']);
Route::get('Empleados', [EmpleadoController::class,'index']);
Route::post('Empleados', [EmpleadoController::class,'store']);
Route::post('Empleados/{IdEmpleado}', [EmpleadoController::class,'update']);
Route::get('Titulo', [TituloController::class,'index']);
Route::get('Cargo', [CargoController::class,'index']);
Route::post('MateriaPrimaAnular/{IdRegistroMP}', [RegistroMateriaPrimaController::class,'destroy']);



// Route::put('MateriaPrima', [RegistroMateriaPrimaController::class, 'update']);
// Route::delete('MateriaPrima', [RegistroMateriaPrimaController::class, 'destroy']);



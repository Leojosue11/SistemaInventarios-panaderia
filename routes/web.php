<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroMateriaPrimaController;


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
Route::get('MateriaPrima', [RegistroMateriaPrimaController::class, 'index']);
// Route::put('MateriaPrima', [RegistroMateriaPrimaController::class, 'update']);
// Route::delete('MateriaPrima', [RegistroMateriaPrimaController::class, 'destroy']);



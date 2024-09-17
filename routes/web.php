<?php

use App\Http\Controllers\EmprendedorController;
use App\Http\Controllers\EmprendimientoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    /*Emprendedor*/
    Route::resource('emprendedor', EmprendedorController::class)->except('update', 'delete', 'search');
    Route::post('/emprendedor/update/{idEmprendedor}', [EmprendedorController::class, 'update']);
    Route::delete('/emprendedor/delete/{idEmprendedor}', [EmprendedorController::class, 'destroy']);
    Route::get('/searchEmprendedor', [EmprendedorController::class, 'search']);
    Route::get('/emprendedor/validacion/campo', [EmprendedorController::class, 'validacionCampo']);
    
    /*Parámetros*/
    Route::resource('/parametros/productos', ProductoController::class)->except('update', 'delete', 'store');
    Route::get('/parametros/productos/showEmprendedor/{idEmprendedor}', [ProductoController::class, 'showByEmprendedor']);
    Route::post('/parametros/productos/store', [ProductoController::class, 'store']);
    Route::get('/parametros/getProductos', [ProductoController::class, 'showByEmprendedor']);
    Route::delete('/parametros/productos/delete/{idProducto}', [ProductoController::class, 'destroy']);
    Route::get('/parametros/emprendimientoByProducto/{idProducto}', [ProductoController::class, 'emprendimientoByProducto']);

});

require __DIR__.'/auth.php';
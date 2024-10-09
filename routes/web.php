<?php

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
   return redirect('/home');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {

   Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

   Route::get('/empresa', [App\Http\Controllers\EmpresaController::class, 'index']);
   Route::get('/empresa/getAll', [App\Http\Controllers\EmpresaController::class, 'getAll']);
   Route::post('/empresa', [App\Http\Controllers\EmpresaController::class, 'store']);
   Route::get('/empresa/{id}/edit', [App\Http\Controllers\EmpresaController::class, 'edit']);
   Route::post('/empresa/{id}/update', [App\Http\Controllers\EmpresaController::class, 'update']);
   Route::delete('/empresa/{id}/delete', [App\Http\Controllers\EmpresaController::class, 'destroy']);

   Route::get('/clientes', [App\Http\Controllers\ClientesController::class, 'index']);
   Route::get('/clientes/getAll', [App\Http\Controllers\ClientesController::class, 'getAll']);
   Route::post('/clientes', [App\Http\Controllers\ClientesController::class, 'store']);
   Route::get('/clientes/{id}/edit', [App\Http\Controllers\ClientesController::class, 'edit']);
   Route::post('/clientes/{id}/update', [App\Http\Controllers\ClientesController::class, 'update']);
   Route::delete('/clientes/{id}/delete', [App\Http\Controllers\ClientesController::class, 'destroy']);

   Route::get('/productos', [App\Http\Controllers\ProductosController::class, 'index']);
   Route::get('/productos/getAll', [App\Http\Controllers\ProductosController::class, 'getAll']);
   Route::post('/productos', [App\Http\Controllers\ProductosController::class, 'store']);
   Route::get('/productos/{id}/edit', [App\Http\Controllers\ProductosController::class, 'edit']);
   Route::post('/productos/{id}/update', [App\Http\Controllers\ProductosController::class, 'update']);
   Route::delete('/productos/{id}/delete', [App\Http\Controllers\ProductosController::class, 'destroy']);

   Route::get('/mis-cotizaciones', [App\Http\Controllers\CotizacionesController::class, 'index']);
   Route::get('/nueva-cotizacion', [App\Http\Controllers\CotizacionesController::class, 'nueva']);
   Route::post('/cotizaciones', [App\Http\Controllers\CotizacionesController::class, 'store']);
   Route::post('/cotizaciones/update', [App\Http\Controllers\CotizacionesController::class, 'update']);
   Route::get('/cotizaciones/getAll', [App\Http\Controllers\CotizacionesController::class, 'getAll']);
   Route::get('/cotizaciones/{id}/edit', [App\Http\Controllers\CotizacionesController::class, 'edit']);
   Route::get('/cotizaciones/{id}/delete', [App\Http\Controllers\CotizacionesController::class, 'destroy']);

   Route::get('/cotizaciones/pdf', [App\Http\Controllers\CotizacionesController::class, 'pdf']);
});
/*
Route::get('/clear', function () {
	//Artisan::call('storage:link');
	Artisan::call('cache:clear');
	Artisan::call('config:cache');
	Artisan::call('view:clear');
	Artisan::call('optimize:clear');
	return "Cleared!";
});
*/

<?php

use Illuminate\Support\Facades\Auth;
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
<<<<<<< HEAD
	return redirect('/home');
=======
   return redirect('/home');
>>>>>>> 6748403f17b9347b01d1614852f7afa4f7ec0e09
});

Auth::routes();
Route::middleware(['auth'])->group(function () {

<<<<<<< HEAD
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

	Route::group(['prefix' => 'register'], function () {
		Route::get('/', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
		Route::post('/', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register.create');
	});
	Route::get('/auth/index', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register.index');
	Route::get('/auth/getAll', [App\Http\Controllers\Auth\RegisterController::class, 'getAll']);
	Route::delete('/auth/{id}/delete', [App\Http\Controllers\Auth\RegisterController::class, 'destroy']);
});

Route::get('/clear', function () {
	Artisan::call('storage:link');
=======
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
>>>>>>> 6748403f17b9347b01d1614852f7afa4f7ec0e09
	Artisan::call('cache:clear');
	Artisan::call('config:cache');
	Artisan::call('view:clear');
	Artisan::call('optimize:clear');
	return "Cleared!";
});
<<<<<<< HEAD
=======
*/
>>>>>>> 6748403f17b9347b01d1614852f7afa4f7ec0e09

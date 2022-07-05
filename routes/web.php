<?php

use Illuminate\Support\Facades\Route;
// use Session;
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

Route::resource('/', App\Http\Controllers\MainController::class);
Route::resource('dashboard', App\Http\Controllers\DashboardController::class);

Route::get('/getsession', function(){
	return Session::all();
});
// Route Setup
Route::resource('company', App\Http\Controllers\Setup\CompanyController::class);
Route::any('company/{id}', [App\Http\Controllers\Setup\CompanyController::class, 'update']);

Route::resource('role', App\Http\Controllers\Setup\RoleController::class);
Route::resource('rolemenu', App\Http\Controllers\Setup\RolemenuController::class);
Route::resource('menu', App\Http\Controllers\Setup\MenuController::class);
Route::resource('user', App\Http\Controllers\Setup\UserController::class);
Route::resource('usercomp', App\Http\Controllers\Setup\UsercompController::class);
Route::resource('gantipass', App\Http\Controllers\Setup\GantipassController::class);

//Route Maser
Route::resource('docs', App\Http\Controllers\Master\DocsController::class);
Route::resource('bendahara', App\Http\Controllers\Master\BendaharaController::class);
Route::resource('coa', App\Http\Controllers\Master\CoaController::class);
Route::resource('paketlangganan', App\Http\Controllers\Master\PaketController::class);
Route::resource('periodebayar', App\Http\Controllers\Master\PeriodeController::class);
Route::resource('statusaktif', App\Http\Controllers\Master\StatusaktifController::class);

//Route Pelanggan
Route::resource('datapelanggan', App\Http\Controllers\Transaksi\PelangganController::class);
Route::resource('tagihan', App\Http\Controllers\Transaksi\TagihanController::class);
Route::post('createtagihan', [App\Http\Controllers\Transaksi\TagihanController::class,'createTagihan']);
Route::resource('pelangganbayar', App\Http\Controllers\Transaksi\PelangganbayarController::class);
Route::post('pelangganbayarsearch', [App\Http\Controllers\Transaksi\PelangganbayarController::class,'searching']);

// Route Autocomplete
Route::resource('comboparent', App\Http\Controllers\Combo\Master\ComboparentController::class);
Route::resource('comborole', App\Http\Controllers\Combo\Master\ComboroleController::class);
Route::resource('combocoa', App\Http\Controllers\Combo\Master\CombocoaController::class);
Route::resource('comboperiode', App\Http\Controllers\Combo\Master\ComboperiodeController::class);
Route::resource('combopaket', App\Http\Controllers\Combo\Master\CombopaketController::class);
Route::resource('combostatus', App\Http\Controllers\Combo\Master\CombostatusController::class);

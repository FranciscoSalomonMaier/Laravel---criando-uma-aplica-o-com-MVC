<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeasonsController;

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
    // return view('welcome');
    return redirect('/series');
});

// Route::get('/series', [SeriesController::class, 'index']);
// Route::get('/series/criar', [SeriesController::class, 'create']);
// Route::post('/series/salvar', [SeriesController::class, 'store']);    

//Laravel 9
// Route::controller(SeriesController::class)->group(function(){
//     Route::get('/series', 'index')->name('series.index');
//     Route::get('/series/criar', 'create')->name('series.create');
//     Route::post('/series/salvar', 'store')->name('series.store');
// });

//Resume a rota para o mesmo controller
//Porém, ela obriga a utilização dos método em inglês, como store, create, etc..;
//Isso pode ser resolvido ao chamar a função route na definição da rota dentro dos redirecionamentos de formulário ou outros.
//Route::resource('/series', SeriesController::class)->only(['index', 'create', 'store', 'destroy', 'edit', 'update']);
Route::resource('/series', SeriesController::class)->except(['show']);

Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');


// Route::post('/series/destroy/{serie}', [SeriesController::class, 'destroy'])->name('series.destroy');

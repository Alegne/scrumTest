<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\TacheController;
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

//Route pour le ActiviteController
Route::get('/activiteListe/{q?}', [ActiviteController::class, 'index'])->name('activiteListeIndex');
Route::post('/activiteListe', [ActiviteController::class, 'store'])->name('activiteListeStore');
Route::patch('/activiteListe/{id}', [ActiviteController::class, 'update'])->name('activiteListeUpdate');
Route::delete('/activiteListe/{id}', [ActiviteController::class, 'destroy'])->name('activiteListeDestroy');


//Route pour le TacheController
//Route::get('tacheListe/{id}', 'TacheController@index');
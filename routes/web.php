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
Route::patch('/activiteListe/{id}', [ActiviteController::class, 'update'])->name('activiteListeUpdate');
Route::delete('/activiteListe/{id}', [ActiviteController::class, 'destroy'])->name('activiteListeDestroy');
Route::post('/activiteListe/{q?}', [ActiviteController::class, 'store'])->name('ctiviteListeStore');

//ceux qui concrene le dash sur l'activite
Route::get('/activiteDash', [ActiviteController::class, 'dashRecupere'])->name('activiteDashRecupere');
Route::get('/tacheListe/{q?}/', [TacheController::class, 'dashRecupere'])->name('tacheDashRecupere');

//Route pour le TacheController
Route::get('/tacheListe/{q?}/{crit?}', [TacheController::class, 'index'])->name('tacheListeIndex');
Route::get('/searchListe/{q?}', [TacheController::class, 'index'])->name('tacheListeIndex');
Route::post('/tacheListe/{q?}', [TacheController::class, 'store'])->name('tacheListeStore');
Route::patch('/tacheListe/{id}', [TacheController::class, 'update'])->name('tacheListeUpdate');
Route::delete('/tacheListe/{id}', [TacheController::class, 'destroy'])->name('tacheListeDestroy');
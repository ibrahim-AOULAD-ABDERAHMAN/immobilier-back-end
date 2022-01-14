<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\AnnonceVisiteurController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BoiteDeReceptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    // Annonces
    Route::post('/annonces',                    [AnnonceController::class, 'store'])->name('annonces.store');
    Route::post('/annonces/{id}',               [AnnonceController::class, 'update'])->name('annonces.update');
    Route::delete('/annonces/{id}',             [AnnonceController::class, 'delete'])->name('annonces.delete');
    Route::put('/annonce-active/{id}',          [AnnonceController::class, 'active'])->name('annonces.active');
    Route::put('/annonce-unactive/{id}',        [AnnonceController::class, 'unactive'])->name('annonces.unactive');


    // Boite de reception
    Route::get('/boite_de_receptions',            [BoiteDeReceptionController::class, 'index'])->name('boite_de_receptions.index');
    Route::get('/boite_de_reception/{id}',        [BoiteDeReceptionController::class, 'show'])->name('boite_de_receptions.show');
    Route::put('/boite_de_receptions/{id}',       [BoiteDeReceptionController::class, 'update'])->name('boite_de_receptions.update');
    Route::post('/boite_de_receptions-delete',    [BoiteDeReceptionController::class, 'delete'])->name('boite_de_receptions.delete');
    Route::post('/boite_de_receptions-filter',    [BoiteDeReceptionController::class, 'getByFilter'])->name('boite_de_receptions.getByFilter');

    // Articles
    Route::get('/article/{id}',                  [ArticleController::class, 'show'])->name('articles.show');
    Route::post('/articles',                     [ArticleController::class, 'store'])->name('articles.store');
    Route::post('/articles/{id}',                [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}',              [ArticleController::class, 'delete'])->name('articles.delete');
    Route::post('/articles-filter',              [ArticleController::class, 'getByFilter'])->name('articles.getByFilter');
    Route::put('/articles-active/{id}',          [ArticleController::class, 'active'])->name('articles.active');
    Route::put('/articles-unactive/{id}',        [ArticleController::class, 'unactive'])->name('articles.unactive');

    // Free routes -----------------------------------------------------------------------------------------------------------

    // Boite messages
    Route::post('/boite_de_receptions',           [BoiteDeReceptionController::class, 'store'])->name('boite_de_receptions.store');

    // Articles
    Route::get('/articles',                      [ArticleController::class, 'index'])->name('articles.index');

    // Annonces visiteurs
    Route::get('/annonces',                     [AnnonceController::class, 'index'])->name('annonces.index');
    Route::get('/annonce/{id}',                 [AnnonceController::class, 'show'])->name('annonces.show');
    Route::post('/annonces-filter',             [AnnonceController::class, 'getByFilter'])->name('annonces.getByFilter');



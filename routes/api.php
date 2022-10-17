<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NiveauController;

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
// CRUD api
Route::apiResource('etudiant', EtudiantController::class);
Route::apiResource('modules', ModulesController::class);
Route::apiResource('niveau', NiveauController::class);

// All students API route
Route::get('/all', [EtudiantController::class, 'all_etudiant'])->name('etudiant.all');
Route::get('/note_etu/{id}', [EtudiantController::class, 'note_etudiant'])->name('note.etudiant');
Route::get('/liste', [EtudiantController::class, 'get_student'])->name('etudiant.liste');

// All modules API route
Route::post('/modules', [ModulesController::class, 'create'])->name('modules.create');
Route::get('/details/{id}', [ModulesController::class, 'details'])->name('modules.detail');
Route::get('/view/{id}', [ModulesController::class, 'view'])->name('modules.view');

// All note API route
Route::get('/note/{id}', [NoteController::class, 'resultat'])->name('resultat.all');
Route::get('/test', [NoteController::class, 'test'])->name('note.test');

// All niveau API route
Route::get('/niveau', [NiveauController::class, 'index'])->name('niveau.all');

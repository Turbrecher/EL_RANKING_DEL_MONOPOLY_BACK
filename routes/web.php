<?php

use App\Controllers\AdminController;
use App\Controllers\FormController;
use Lib\Route;
use App\Controllers\HomeController;
use App\Controllers\ScoreController;

//admin
Route::get('/admin', [AdminController::class, 'vistaAdmin']);
Route::get('/admin/eliminar/jugador/:id', [AdminController::class, 'deleteJugador']);
Route::get('/admin/eliminar/torneo/:id', [AdminController::class, 'deleteTorneo']);
Route::get('/admin/eliminar/partida/:id', [AdminController::class, 'deletePartida']);

//Vista HOME y ERROR
Route::get('/', [HomeController::class, 'home']);
Route::get('/error', [HomeController::class, 'error']);


//Vistas puntuaciones
Route::get('/puntuaciones/elegirTorneo', [ScoreController::class, 'elegirTorneo']);
Route::get('/puntuaciones/generales/:id', [ScoreController::class, 'puntuacionesGenerales']);
Route::get('/puntuaciones/partida/:id', [ScoreController::class, 'puntuacionesPartida']);

//Vistas Formularios
Route::get('/crear/torneo', [FormController::class, 'vistaCrearTorneo']);
Route::get('/crear/partida', [FormController::class, 'vistaCrearPartida']);
Route::get('/crear/partida/posiciones', [FormController::class, 'vistaCrearPartidaPosiciones']);
Route::get('/crear/jugador', [FormController::class, 'vistaCrearJugador']);

//Acciones Formularios
Route::post('/crear/jugador', [FormController::class, 'crearJugador']);
Route::post('/crear/torneo', [FormController::class, 'crearTorneo']);
Route::post('/crear/partida', [FormController::class, 'crearPartida']);

Route::dispatch();
<?php

use App\Controllers\FormController;
use Lib\Route;
use App\Controllers\HomeController;
use App\Controllers\ScoreController;

//Vista HOME
Route::get('/', [HomeController::class, 'home']);

//Vistas PUNTUACIONES
Route::get('/puntuaciones/elegirTorneo', [ScoreController::class, 'elegirTorneo']);
Route::get('/puntuaciones/generales', [ScoreController::class, 'puntuacionesGenerales']);
Route::get('/puntuaciones/partida', [ScoreController::class, 'puntuacionesPartida']);


//Vistas FORMULARIOS
Route::get('/crear/torneo', [FormController::class, 'vistaCrearTorneo']);
Route::get('/crear/partida', [FormController::class, 'vistaCrearPartida']);
Route::get('/crear/partida/posiciones', [FormController::class, 'vistaCrearPartidaPosiciones']);
Route::get('/crear/jugador', [FormController::class, 'vistaCrearJugador']);

Route::dispatch();
<?php

namespace App\Controllers;

class ScoreController extends Controller
{
    public function elegirTorneo()
    {
        session_start();
        return $this->view('/puntuaciones/elegirTorneo'); // Seleccionamos una vista (método padre)
    }

    public function puntuacionesGenerales()
    {
        session_start();
        return $this->view('/puntuaciones/generales'); // Seleccionamos una vista (método padre)
    }

    public function puntuacionesPartida()
    {
        session_start();
        return $this->view('/puntuaciones/partida'); // Seleccionamos una vista (método padre)
    }
}
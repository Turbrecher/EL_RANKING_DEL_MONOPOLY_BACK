<?php

namespace App\Controllers;

use App\Models\JugadorModel;
use App\Models\PartidaModel;
use App\Models\PuntuacionPartidaModel;
use App\Models\PuntuacionTorneoModel;
use App\Models\TorneoModel;

class ScoreController extends Controller
{
    public function elegirTorneo(): string|false
    {
        $torneoModel = new TorneoModel();
        $torneos = $torneoModel->getTorneos();
        return $this->view('/puntuaciones/elegirTorneo', $torneos); // Seleccionamos una vista (método padre)
    }

    public function puntuacionesGenerales($idTorneo): string|false
    {
        $puntuacionTorneoModel = new PuntuacionTorneoModel();
        $partidaModel = new PartidaModel();
        $jugadorModel = new JugadorModel();
        $puntuacionesGenerales = $puntuacionTorneoModel->getPuntuacionesTorneo($idTorneo);
        $partidas = $partidaModel->getPartidasDeTorneo($idTorneo);
        return $this->view('/puntuaciones/generales', [$puntuacionesGenerales, $partidas]); // Seleccionamos una vista (método padre)
    }

    public function puntuacionesPartida(int $idPartida): string|false
    {
        $puntuacionPartidaModel = new PuntuacionPartidaModel();
        $puntuacionesPartida = $puntuacionPartidaModel->getPuntuacionesPartida($idPartida);
        return $this->view('/puntuaciones/partida', $puntuacionesPartida); // Seleccionamos una vista (método padre)
    }
}
<?php

namespace App\Controllers;

use App\Models\JugadorModel;
use App\Models\PartidaModel;
use App\Models\PuntuacionModel;
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
        $puntuacionModel = new PuntuacionModel();
        $partidaModel = new PartidaModel();
        $jugadorModel = new JugadorModel();
        $jugadores = $jugadorModel->getJugadores();

        $puntuacionesGenerales = $puntuacionModel->getPuntuacionTorneo($idTorneo, $jugadores);
        $partidas = $partidaModel->getPartidasDeTorneo($idTorneo);
        return $this->view('/puntuaciones/generales', [$puntuacionesGenerales, $partidas]); // Seleccionamos una vista (método padre)
    }

    public function puntuacionesPartida(int $idPartida): string|false
    {
        $partidaModel = new PartidaModel();
        $nombrePartida = $partidaModel->getNombrePartida($idPartida);
        $puntuacionModel = new PuntuacionModel();
        $jugadorModel = new JugadorModel();
        $jugadores = $jugadorModel->getJugadores();

        $puntuacionesPartida = $puntuacionModel->getPuntuacionPartida($idPartida, $jugadores);
        return $this->view('/puntuaciones/partida', [$puntuacionesPartida, $nombrePartida]); // Seleccionamos una vista (método padre)
    }
}
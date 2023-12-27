<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\JugadorModel;
use App\Models\PartidaModel;
use App\Models\PuntuacionPartidaModel;
use App\Models\PuntuacionTorneoModel;
use App\Models\TorneoModel;

class AdminController extends Controller
{
    public function vistaAdmin(): string
    {
        $partidaModel = new PartidaModel();
        $jugadorModel = new JugadorModel();
        $torneoModel = new TorneoModel();

        $partidas = $partidaModel->getPartidas();
        $jugadores = $jugadorModel->getJugadores();
        $torneos = $torneoModel->getTorneos();


        return $this->view('admin', [$partidas, $jugadores, $torneos]);
    }

    public function deleteJugador(string $nick): void
    {
        $puntuacionPartidaModel = new PuntuacionPartidaModel();
        $puntuacionTorneoModel = new PuntuacionTorneoModel();
        $jugadorModel = new JugadorModel();

        if ($puntuacionPartidaModel->getPartidasJugadas($nick) > 0) {
            $this->redirect('/error');
            return;
        }

        $puntuacionPartidaModel->deletePuntuacionPartida($nick);
        $puntuacionTorneoModel->deletePuntuacionTorneo($nick);

        if (!$jugadorModel->deleteJugador($nick)) {
            $this->redirect('/error');
        } else {
            $this->redirect('/admin');
        }


    }

    public function deleteTorneo($id): void
    {
        $partidaModel = new PartidaModel();
        $torneoModel = new TorneoModel();

        //Comprobar si se han jugado partida en ese torneo.
        if (sizeof($partidaModel->getPartidasDeTorneo($id)) > 0) {
            $this->redirect('/error');
            return;
        }

        //Borrar torneo si no se han jugado partidas.
        $torneoModel->deleteTorneo($id);
        $this->redirect('/admin');

    }

    public function deletePartida($id): string
    {
        //Comprobamos
    }
}
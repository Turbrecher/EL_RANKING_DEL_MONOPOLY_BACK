<?php

namespace App\Controllers;

use App\Models\JugadorModel;
use App\Models\PartidaModel;
use App\Models\PuntuacionModel;
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
        $puntuacionModel = new PuntuacionModel();

        $jugadorModel = new JugadorModel();

        if ($puntuacionModel->getNumeroPuntuaciones($nick) > 0) {
            $this->redirect('/error');
            return;
        }

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

    public function deletePartida($id): void
    {

        //Borramos todas las puntuaciones pertenecientes a la partida jugada.
        $puntuacionModel = new PuntuacionModel();
        if (!$puntuacionModel->deletePuntuacionPartida($id)) {
            $this->redirect('/error');
            return;
        }


        //Borramos la partida.
        $partidaModel = new PartidaModel();

        if (!$partidaModel->deletePartida($id)) {
            $this->redirect('/error');
            return;
        }

        $this->redirect('/admin');
    }
}
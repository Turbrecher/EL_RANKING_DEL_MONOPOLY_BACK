<?php

namespace App\Controllers;

class FormController extends Controller
{
    public function vistaCrearPartida()
    {
        return $this->view('formularios/crearPartida');
    }

    public function crearPartida()
    {

    }

    public function vistaCrearPartidaPosiciones(){
        return $this->view('formularios/posicionesPartida');
    }

    public function vistaCrearTorneo()
    {
        return $this->view('formularios/crearTorneo');
    }

    public function crearTorneo()
    {

    }

    public function vistaCrearJugador()
    {
        return $this->view('formularios/crearJugador');
    }

    public function crearJugador()
    {

    }


}
<?php

namespace App\Controllers;

use \App\DataClasses\Jugador;
use App\DataClasses\Partida;
use App\DataClasses\PuntuacionPartida;
use App\DataClasses\PuntuacionTorneo;
use App\DataClasses\Torneo;
use App\Models\JugadorModel;
use App\Models\PartidaModel;
use App\Models\PuntuacionPartidaModel;
use App\Models\PuntuacionTorneoModel;
use App\Models\TorneoModel;
use App\UsefulClasses\CalculadoraPuntos;

class FormController extends Controller
{
    public function vistaCrearPartida(): string
    {
        $torneoModel = new TorneoModel();
        $torneos = $torneoModel->getTorneos();

        return $this->view('formularios/crearPartida', $torneos);
    }

    public function crearPartida(): string
    {

        //crear partida.
        $partidaModel = new PartidaModel();
        $partida = new Partida($_POST['nombre'], $_POST['fecha'], $_POST['1'], $_POST['torneo']);
        $partidaModel->insertarPartida($partida);


        for ($i = 1; $i <= $_POST['nJugadores']; $i++) {

            //crear puntuacion partida por cada jugador.
            $nickJugador = $_POST[$i];
            $idPartida = $partidaModel->getIdPartida($_POST['nombre']);
            $puntos = CalculadoraPuntos::calcularPuntos($_POST['nJugadores'], $i);

            $puntuacionPartida = new PuntuacionPartida($nickJugador, $idPartida, $puntos);

            $puntuacionPartidaModel = new PuntuacionPartidaModel();
            $puntuacionPartidaModel->insertarPuntuacionPartida($puntuacionPartida);

            //actualizar puntuacion torneo.
            $idTorneo = $_POST['torneo'];
            $puntuacionTorneo = new PuntuacionTorneo($nickJugador, $idTorneo, $puntos);
            $puntuacionTorneoModel = new PuntuacionTorneoModel();
            $puntuacionTorneoModel->insertarPuntuacionTorneo($puntuacionTorneo);

        }


        return $this->view('home');


    }

    public function vistaCrearPartidaPosiciones(): string
    {
        $GET_RECIBIDO = !empty($_GET['nombre']) && !empty($_GET['nJugadores']) && !empty($_GET['torneo']) && !empty($_GET['fecha']);
        if (!$GET_RECIBIDO) {
            return $this->view('error');
        }

        $validador = new ValidadorCampos();
        if (!$validador->registroPartidaValido($_GET)) {
            return $this->view('error');
        }
        $jugadorModel = new JugadorModel();
        $jugadores = $jugadorModel->getJugadores();

        return $this->view('formularios/posicionesPartida', [$_GET, $jugadores]);
    }

    public function vistaCrearTorneo(): string
    {
        return $this->view('formularios/crearTorneo');
    }

    public function crearTorneo(): string
    {
        //Comprobamos que todos los datos del post se hayan recibido (LOS 3 CAMPOS DE LA BBDD SON NOT NULL).
        $POST_RECIBIDO = !empty($_POST['nombre']) && !empty($_POST['fInicio']) && !empty($_POST['fFin']);
        if (!$POST_RECIBIDO) {
            return $this->view('error');
        }

        //Comprobamos que los datos introducidos en el formulario son validos.
        $validador = new ValidadorCampos();
        if (!$validador->registroTorneoValido($_POST)) {
            return $this->view('error');
        }

        //Intentamos insertar los datos en la base de datos.
        $torneoModel = new TorneoModel();
        $torneo = new Torneo($_POST['nombre'], $_POST['fInicio'], $_POST['fFin']);
        if (!$torneoModel->insertarTorneo($torneo)) {
            return $this->view('error');
        }


        //Si ha salido bien, nos devuelve a la pagina de inicio.
        return $this->view('home');
    }

    public function vistaCrearJugador(): string
    {
        return $this->view('formularios/crearJugador');
    }


    /**
     * Funcion que se encarga de crear un nuevo jugador en la base de datos.
     * @return string (la nueva vista en formato texto)
     */
    public function crearJugador(): string
    {
        //Comprobamos que todos los datos del post se hayan recibido (LOS 3 CAMPOS DE LA BBDD SON NOT NULL).
        $POST_RECIBIDO = !empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['nick']);
        if (!$POST_RECIBIDO) {
            return $this->view('error');
        }

        //Comprobamos que los datos introducidos en el formulario son validos.
        $validador = new ValidadorCampos();
        if (!$validador->registroUsuarioValido($_POST)) {
            return $this->view('error');
        }

        //Intentamos insertar los datos en la base de datos.
        $jugadorModel = new JugadorModel();
        $jugador = new Jugador($_POST['nombre'], $_POST['apellidos'], $_POST['nick']);
        if (!$jugadorModel->insertarJugador($jugador)) {
            return $this->view('error');
        }


        //Si ha salido bien, nos devuelve a la pagina de inicio.
        return $this->view('home');
    }


}
<?php

namespace App\Controllers;

use \App\DataClasses\Jugador;
use App\DataClasses\Partida;
use App\DataClasses\Puntuacion;
use App\DataClasses\Torneo;
use App\Models\JugadorModel;
use App\Models\PartidaModel;
use App\Models\PuntuacionModel;
use App\Models\TorneoModel;
use App\UsefulClasses\CalculadoraPuntos;
use App\UsefulClasses\ContadorCoincidencias;

class FormController extends Controller
{
    /**
     * Metodo que carga la vista del formulario de creacion de partidas.
     * @return string (la vista)
     */
    public function vistaCrearPartida(): string
    {
        //Hay que obtener los torneos que existen para rellenar el elemento select del formulario.
        $torneoModel = new TorneoModel();
        $torneos = $torneoModel->getTorneos();

        $jugadorModel = new JugadorModel();
        $nJugadores = count($jugadorModel->getJugadores());


        return $this->view('formularios/crearPartida', [$torneos, $nJugadores]);
    }

    /**
     * Metodo que se encarga de crear la partida y las tablas relacionadas con ella (puntuaciones)
     * @return string (la vista)
     */
    public function crearPartida(): string
    {
        //Comprobamos que hayamos recibido los 4 parametros del post.
        $POST_RECIBIDO = !empty($_POST['nombre']) && !empty($_POST['fecha']) && !empty($_POST['torneo']) && !empty($_POST['nJugadores']);
        if (!$POST_RECIBIDO) {
            return $this->view("/error");
        }

        //Validamos el post.
        $validador = new ValidadorCampos();
        if (!$validador->registroPartidaValido($_POST)) {
            return $this->view("/error");
        }

        //Creamos objeto partida con los datos del POST.
        $partida = new Partida($_POST['nombre'], $_POST['fecha'], $_POST['1'], $_POST['torneo']);
        $partidaModel = new PartidaModel();

        //Comprobamos que el jugador existe y lo almacenamos en un array de nicks.
        $jugadorModel = new JugadorModel();
        $nicksJugadores = [];
        for ($i = 1; $i <= $_POST['nJugadores']; $i++) {

            if (!$jugadorModel->jugadorExiste($_POST[$i])) {
                return $this->view("/error");
            }

            $nicksJugadores[] = $_POST[$i];
        }

        //Comprobamos que ningun nick se repita.
        for ($i = 1; $i <= $_POST['nJugadores']; $i++) {
            if (ContadorCoincidencias::contarCoincidencias($_POST[$i], $nicksJugadores) > 1) {
                return $this->view("/error");
            }
        }

        //Si la partida ya existe, vista de error.
        if ($partidaModel->partidaExiste($partida->getNombre())) {
            return $this->view("/error");
        }

        //Intentamos insertar la partida en la base de datos.
        //Si hay alguna excepcion adicional al intentar insertarlo en la base de datos, vista de error de tambien.
        if (!$partidaModel->insertarPartida($partida)) {
            return $this->view("/error");
        }

        //Ahora, por cada jugador que participa, insertamos y actualizamos puntuaciones.
        for ($i = 1; $i <= $_POST['nJugadores']; $i++) {

            //crear puntuacion partida por cada jugador.
            $nickJugador = $_POST[$i];
            $idPartida = $partidaModel->getIdPartida($_POST['nombre']);
            $idTorneo = $_POST['torneo'];
            $puntos = CalculadoraPuntos::calcularPuntos($_POST['nJugadores'], $i);

            $puntuacionModel = new PuntuacionModel();
            $puntuacion = new Puntuacion($idTorneo, $idPartida, $nickJugador, $puntos);
            $puntuacionModel->insertarPuntuacion($puntuacion);

        }
        //AL TERMINAR DE INSERTAR LA NUEVA PARTIDA CON SUS PUNTUACIONES, REDIRIGIMOS A LA VISTA DE VISUALIZACION DE PUNTUACIONES.
        $torneoModel = new TorneoModel();
        $torneos = $torneoModel->getTorneos();
        return $this->view('/puntuaciones/elegirTorneo', $torneos);


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
            return $this->view('/error');
        }

        //Comprobamos que los datos introducidos en el formulario son validos.
        $validador = new ValidadorCampos();
        if (!$validador->registroTorneoValido($_POST)) {
            return $this->view('/error');
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
        $jugadorModel = new JugadorModel();
        //Comprobamos que todos los datos del post se hayan recibido (LOS 3 CAMPOS DE LA BBDD SON NOT NULL).
        $POST_RECIBIDO = !empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['nick']);
        if (!$POST_RECIBIDO) {
            return $this->view('/error');
        }

        //Comprobamos que los datos introducidos en el formulario son validos.
        $validador = new ValidadorCampos();
        if (!$validador->registroUsuarioValido($_POST)) {
            return $this->view('/error');
        }

        if ($jugadorModel->jugadorExiste($_POST['nick'])) {
            return $this->view('/error');
        }

        //Intentamos insertar los datos en la base de datos.
        $jugador = new Jugador($_POST['nombre'], $_POST['apellidos'], $_POST['nick']);
        if (!$jugadorModel->insertarJugador($jugador)) {
            return $this->view('/error');
        }


        //Si ha salido bien, nos devuelve a la pagina de inicio.
        return $this->view('home');
    }


}
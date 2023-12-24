<?php
declare(strict_types=1);

namespace App\Controllers;
class ValidadorCampos
{
    public function __construct()
    {

    }

    public function registroUsuarioValido(array $campos): bool
    {

        if (!$this->nombreValido($campos['nombre'])) {
            return false;
        }

        if (!$this->apellidoValido($campos['apellidos'])) {
            return false;
        }

        if (!$this->nickValido($campos['nick'])) {
            return false;
        }

        return true;
    }

    public function registroTorneoValido(array $campos): bool
    {
        if (!$this->nombreValido($campos['nombre'])) {
            return false;
        }

        if (!$this->fechaValida($campos['fInicio'])) {
            return false;
        }

        if (!$this->fechaValida($campos['fFin'])) {
            return false;
        }

        return true;
    }

    public function registroPartidaValido(array $campos): bool
    {
        if (!$this->nombreValido($campos['nombre'])) {
            return false;
        }

        if (!$this->fechaValida($campos['fecha'])) {
            return false;
        }

        if (!$this->numeroValido($campos['nJugadores'])) {
            return false;
        }
        if (!$this->numeroValido($campos['torneo'])) {
            return false;
        }

        return true;
    }

    private function numeroValido(string $numero): bool
    {
        if (!is_numeric($numero)) {
            return false;
        }

        if ($numero < 0) {
            return false;
        }

        return true;
    }


    private
    function fechaValida(string $fecha): bool
    {
        $fecha = htmlspecialchars($fecha);

        if (preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/', $fecha) === false) {
            return false;
        }
        $year = explode('-', $fecha)[0];
        $month = explode('-', $fecha)[1];
        $day = explode('-', $fecha)[2];

        if ($month > 12 || $month < 0) {
            return false;
        }

        if ($day < 0 || $day > 31) {
            return false;
        }

        if ($year < 1970 || $year > 2060) {
            return false;
        }


        return true;
    }

    private
    function nombreValido(string $nombre): bool
    {
        $nombre = htmlspecialchars($nombre);

        if (strlen($nombre) > 50) {
            return false;
        }

        return true;
    }

    private
    function apellidoValido(string $apellido): bool
    {
        $apellido = htmlspecialchars($apellido);

        if (strlen($apellido) > 50) {
            return false;
        }

        return true;
    }

    private
    function nickValido(string $nick): bool
    {
        $nick = htmlspecialchars($nick);

        if (strlen($nick) > 50) {
            return false;
        }

        return true;
    }

}
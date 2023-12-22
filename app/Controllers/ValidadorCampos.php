<?php
declare(strict_types=1);

namespace App\Controllers;
class ValidadorCampos
{
    public function __construct()
    {

    }

    public function registroValido(array $campos): bool
    {

        if (!$this->nombreValido($campos['nombre'])) {
            return false;
        }

        if (!$this->apellidoValido($campos['apellidos'])) {
            return false;
        }

        return true;
    }


    private function emailValido(string $email): bool
    {
        $email = htmlspecialchars($email);

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        }

        return true;
    }

    private function nombreValido(string $nombre): bool
    {
        $nombre = htmlspecialchars($nombre);

        if (strlen($nombre) > 50) {
            return false;
        }

        return true;
    }

    private function apellidoValido(string $apellido): bool
    {
        $apellido = htmlspecialchars($apellido);

        if (strlen($apellido) > 50) {
            return false;
        }

        return true;
    }

}
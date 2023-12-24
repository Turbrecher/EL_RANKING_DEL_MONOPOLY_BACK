<?php

namespace App\DataClasses;

class Jugador
{
    public function __construct(private string $nombre, private string $apellidos, private string $nick)
    {
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function getNick(): string
    {
        return $this->nick;
    }


}
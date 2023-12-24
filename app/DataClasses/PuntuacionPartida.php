<?php

namespace App\DataClasses;

class PuntuacionPartida
{

    public function __construct(private string $nickJugador, private int $idPartida, private int $puntos)
    {
    }

    public function getNickJugador(): string
    {
        return $this->nickJugador;
    }

    public function getPuntos(): int
    {
        return $this->puntos;
    }

    public function getIdPartida(): int
    {
        return $this->idPartida;
    }


}
<?php

namespace App\DataClasses;

class PuntuacionTorneo
{
    public function __construct(private string $nickJugador, private int $idTorneo, private int $puntos)
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

    public function getIdTorneo(): int
    {
        return $this->idTorneo;
    }




}
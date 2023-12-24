<?php

namespace App\DataClasses;

class Partida
{
    public function __construct(private string $nombre, private string $fecha, private string $ganador, private int $idTorneo)
    {
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function getGanador(): string
    {
        return $this->ganador;
    }

    public function getIdTorneo(): int
    {
        return $this->idTorneo;
    }

}
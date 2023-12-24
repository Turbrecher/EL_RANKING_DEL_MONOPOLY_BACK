<?php

namespace App\DataClasses;


class Torneo
{

    public function __construct(private string $nombre, private string $fechaInicio, private string $fechaFin)
    {
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getFechaInicio(): string
    {
        return $this->fechaInicio;
    }

    public function getFechaFin(): string
    {
        return $this->fechaFin;
    }


}
<?php

namespace App\DataClasses;

class Puntuacion
{
    public function __construct(private int $id_torneo, private int $id_partida, private string $nick_jugador, private int $puntos)
    {
    }

    public function getIdTorneo(): int
    {
        return $this->id_torneo;
    }

    public function getIdPartida(): int
    {
        return $this->id_partida;
    }

    public function getNickJugador(): string
    {
        return $this->nick_jugador;
    }

    public function getPuntos(): int
    {
        return $this->puntos;
    }


}
<?php

namespace App\Models;

use App\DataClasses\Partida;
use App\DataClasses\PuntuacionPartida;
use App\Models\Model;

class PuntuacionPartidaModel extends Model
{
    public function insertarPuntuacionPartida(PuntuacionPartida $puntuacionPartida): bool
    {
        $nickJugador = $puntuacionPartida->getNickJugador();
        $puntos = $puntuacionPartida->getPuntos();
        $idPartida = $puntuacionPartida->getIdPartida();

        try {
            $statement = $this->connection->prepare(
                'INSERT INTO puntuacion_partida(nick_jugador, id_partida, puntos) VALUES (:nickJugador,:idPartida,:puntos)');
            $statement->bindParam(":nickJugador", $nickJugador);
            $statement->bindParam(":idPartida", $idPartida);
            $statement->bindParam(":puntos", $puntos);
            $statement->execute();

            return true;
        } catch (\PDOException) {
            return false;
        }

    }


    public function getPuntuacionesPartida(int $idPartida): array
    {
        $statement = $this->connection->prepare('SELECT nick_jugador,puntos FROM puntuacion_partida WHERE id_partida = :idPartida order by puntos desc');
        $statement->bindParam(":idPartida", $idPartida);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }
}
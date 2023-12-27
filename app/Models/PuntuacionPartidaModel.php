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


    public function deletePuntuacionPartida(string $nick_jugador, int $id_partida = -1): bool
    {
        if ($id_partida === -1) {
            $statement = $this->connection->prepare('DELETE FROM puntuacion_partida where nick_jugador = :nick_jugador');
            $statement->bindParam(":nick_jugador", $nick_jugador);
            return $statement->execute();
        }

        $statement = $this->connection->prepare('DELETE FROM puntuacion_partida where nick_jugador = :nick_jugador and id_partida = :id_partida');
        $statement->bindParam(":nick_jugador", $nick_jugador);
        $statement->bindParam(":id_partida", $id_partida);
        return $statement->execute();


    }

    public function getPartidasJugadas(string $nick_jugador): int
    {
        $statement = $this->connection->prepare('SELECT COUNT(nick_jugador) FROM puntuacion_partida WHERE nick_jugador = :nick_jugador');
        $statement->bindParam(":nick_jugador", $nick_jugador);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_NUM)[0];
    }

    public function getPartidasEnTorneo(int $id_torneo): int
    {
        $statement = $this->connection->prepare('SELECT COUNT(id) FROM puntuacion_partida WHERE nick_jugador = :nick_jugador');
        $statement->bindParam(":nick_jugador", $nick_jugador);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_NUM)[0];
    }
}
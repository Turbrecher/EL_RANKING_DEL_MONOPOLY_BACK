<?php

namespace App\Models;

use App\DataClasses\Puntuacion;

class PuntuacionModel extends Model
{
    public function insertarPuntuacion(Puntuacion $puntuacion): bool
    {
        $id_torneo = $puntuacion->getIdTorneo();
        $id_partida = $puntuacion->getIdPartida();
        $nick_jugador = $puntuacion->getNickJugador();
        $puntos = $puntuacion->getPuntos();

        try {
            $statement = $this->connection->prepare('INSERT INTO puntuacion VALUES (:nick_jugador, :id_torneo, :id_partida, :puntos);');
            $statement->bindParam(":nick_jugador", $nick_jugador);
            $statement->bindParam(":id_torneo", $id_torneo);
            $statement->bindParam(":id_partida", $id_partida);
            $statement->bindParam(":puntos", $puntos);

            $statement->execute();

            return true;
        } catch (\PDOException $exception) {
            return false;
        }

    }


    public function getPuntuacionTorneo(int $id_torneo, array $jugadores): array|false
    {
        $puntuaciones = [];
        try {
            foreach ($jugadores as $jugador) {
                $nick_jugador = $jugador->nick;
                $statement = $this->connection->prepare('SELECT sum(puntos) as puntos, nick_jugador FROM puntuacion where id_torneo = :id_torneo and nick_jugador = :nick_jugador;');
                $statement->bindParam(":id_torneo", $id_torneo);
                $statement->bindParam(":nick_jugador", $nick_jugador);
                $statement->execute();

                $puntuacion = $statement->fetch(\PDO::FETCH_OBJ);;

                if ($puntuacion->puntos !== null || $puntuacion->nick_jugador !== null) {
                    $puntuaciones[] = $puntuacion;
                }
            }

            rsort($puntuaciones);

            return $puntuaciones;

        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function getPuntuacionPartida(int $id_partida, array $jugadores): array|false
    {

        $puntuaciones = [];
        try {
            foreach ($jugadores as $jugador) {
                $nick_jugador = $jugador->nick;
                $statement = $this->connection->prepare('SELECT sum(puntos) as puntos,nick_jugador FROM puntuacion where id_partida = :id_partida and nick_jugador = :nick_jugador;');
                $statement->bindParam(":id_partida", $id_partida);
                $statement->bindParam(":nick_jugador", $nick_jugador);
                $statement->execute();

                $puntuacion = $statement->fetch(\PDO::FETCH_OBJ);;

                if ($puntuacion->puntos !== null || $puntuacion->nick_jugador !== null) {
                    $puntuaciones[] = $puntuacion;
                }
            }

            rsort($puntuaciones);

            return $puntuaciones;
        } catch (\PDOException $PDOException) {
            return false;
        }
    }

    public function getNumeroPuntuaciones(string $nick_jugador): int
    {
        try {
            $statement = $this->connection->prepare('SELECT COUNT(nick_jugador) FROM puntuacion WHERE nick_jugador = :nick_jugador');
            $statement->bindParam(':nick_jugador', $nick_jugador);
            $statement->execute();

            return $statement->fetch(\PDO::FETCH_NUM)[0];
        } catch (\PDOException $exception) {
            return 0;
        }


    }

    public function deletePuntuacionJugador(string $nick_jugador): bool
    {
        try {
            $statement = $this->connection->prepare('DELETE FROM puntuacion WHERE nick_jugador = :nick_jugador');
            $statement->bindParam(':nick_jugador', $nick_jugador);
            $statement->execute();

            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function deletePuntuacionPartida(int $id_partida): bool
    {
        try {
            $statement = $this->connection->prepare('DELETE FROM puntuacion WHERE id_partida = :id_partida');
            $statement->bindParam(':id_partida', $id_partida);
            $statement->execute();

            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }
}
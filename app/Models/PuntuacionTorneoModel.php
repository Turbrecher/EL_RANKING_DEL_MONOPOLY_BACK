<?php

namespace App\Models;

use App\DataClasses\PuntuacionTorneo;
use App\Models\Model;

class PuntuacionTorneoModel extends Model
{
    public function insertarPuntuacionTorneo(PuntuacionTorneo $puntuacionTorneo): bool
    {
        $nickJugador = $puntuacionTorneo->getNickJugador();
        $puntosObtenidos = $puntuacionTorneo->getPuntos();
        $idTorneo = $puntuacionTorneo->getIdTorneo();

        try {

            $puntosActuales = $this->getPuntosTorneo($nickJugador, $idTorneo);

            //Si el jugador ya existe en la tabla de puntos del torneo.
            if ($puntosActuales) {
                $sumatorioPuntos = $puntosActuales[0] + $puntosObtenidos;
                $statement = $this->connection->prepare(
                    'UPDATE puntuacion_torneo SET puntos=:sumatorioPuntos WHERE nick_jugador=:nickJugador');
                $statement->bindParam(":sumatorioPuntos", $sumatorioPuntos);
                $statement->bindParam(":nickJugador", $nickJugador);
                $statement->execute();

                return true;
            }

            //Si el jugador aun no ha jugado en este torneo.
            $statement = $this->connection->prepare(
                'INSERT INTO puntuacion_torneo(nick_jugador, id_torneo, puntos) VALUES (:nickJugador,:idPartida,:puntos)');
            $statement->bindParam(":nickJugador", $nickJugador);
            $statement->bindParam(":idPartida", $idTorneo);
            $statement->bindParam(":puntos", $puntosObtenidos);
            $statement->execute();

            return true;
        } catch
        (\PDOException) {
            return false;
        }

    }

    public function getPuntosTorneo(string $nickJugador, int $idTorneo): mixed
    {
        $statement = $this->connection->prepare('SELECT PUNTOS FROM puntuacion_torneo WHERE nick_jugador=:nickJugador and id_torneo=:idTorneo');
        $statement->bindParam(":nickJugador", $nickJugador);
        $statement->bindParam(":idTorneo", $idTorneo);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_NUM);
    }

    public function getPuntuacionesTorneo(int $idTorneo): array
    {
        $statement = $this->connection->prepare('SELECT nick_jugador,puntos from puntuacion_torneo where id_torneo = :idTorneo order by puntos desc');
        $statement->bindParam(':idTorneo', $idTorneo);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }
}
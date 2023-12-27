<?php

namespace App\Models;

use App\DataClasses\Partida;

class PartidaModel extends Model
{

    /**
     * Metodo que inserta una partida en la base de datos
     * @param Partida $partida el objeto partida que representa a esta
     * @return bool
     */
    public function insertarPartida(Partida $partida): bool
    {
        $nombre = $partida->getNombre();
        $fecha = $partida->getFecha();
        $ganador = $partida->getGanador();
        $idTorneo = $partida->getIdTorneo();

        try {
            $statement = $this->connection->prepare('INSERT INTO partida(id_torneo, nombre, ganador, fecha) VALUES (:idTorneo,:nombre,:ganador,:fecha)');
            $statement->bindParam(":idTorneo", $idTorneo);
            $statement->bindParam(":nombre", $nombre);
            $statement->bindParam(":ganador", $ganador);
            $statement->bindParam(":fecha", $fecha);
            $statement->execute();

            return true;
        } catch (\PDOException $pdo) {
            return false;
        }

    }

    /**
     * Metodo que obtiene la id de la partida con el nombre introducido como parametro.
     * @param string $nombre
     * @return int
     */
    public function getIdPartida(string $nombre): int
    {
        $statement = $this->connection->prepare('SELECT ID FROM partida WHERE nombre = :nombre');
        $statement->bindParam(":nombre", $nombre);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_NUM)[0];
    }

    /**
     * Metodo que obtiene todas las partidas del torneo con la id introducida como parametro.
     * @param int $idTorneo
     * @return array
     */
    public function getPartidasDeTorneo(int $idTorneo): array
    {
        $statement = $this->connection->prepare('SELECT id,nombre,fecha,ganador FROM partida where id_torneo = :idTorneo');
        $statement->bindParam(":idTorneo", $idTorneo);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getPartidas(): array
    {
        $statement = $this->connection->query('SELECT id,nombre,fecha,ganador,id_torneo FROM PARTIDA');

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * Metodo que obtiene el numero de partidas ganadas de un jugador en un torneo.
     * @param int $idTorneo
     * @param string $nickJugador
     * @return int numero de partidas ganadas.
     */
    public function getPartidasGanadas(int $idTorneo, string $nickJugador): int
    {
        $statement = $this->connection->prepare('SELECT COUNT(id) FROM partida WHERE ganador = :nickJugador and id_torneo = :idTorneo');
        $statement->bindParam(":nickJugador", $nickJugador);
        $statement->bindParam(":idTorneo", $idTorneo);
        $statement->execute();

        if (!$statement->fetch(\PDO::FETCH_NUM)) {
            return 0;
        }
        return $statement->fetch(\PDO::FETCH_NUM);

    }

    public function deletePartida($id): bool
    {
        $statement = $this->connection->prepare('DELETE FROM partida where id = :id');
        $statement->bindParam(":id", $id);
        return $statement->execute();
    }


    public function partidaExiste(string $nombre): bool
    {
        $statement = $this->connection->prepare('SELECT COUNT(id) FROM partida where nombre = :nombre');
        $statement->bindParam('nombre', $nombre);
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_NUM)[0];

        if ($result > 0) {
            return true;
        }


        return false;
    }


}
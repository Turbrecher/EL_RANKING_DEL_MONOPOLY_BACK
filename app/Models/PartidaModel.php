<?php

namespace App\Models;

use App\Models\Model;
use App\DataClasses\Partida;

class PartidaModel extends Model
{
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
        } catch (\PDOException) {
            return false;
        }

    }

    public function getIdPartida(string $nombre): int
    {
        $statement = $this->connection->prepare('SELECT ID FROM partida WHERE nombre = :nombre');
        $statement->bindParam(":nombre", $nombre);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_NUM)[0];
    }

    public function getPartidas(int $idTorneo): array
    {
        $statement = $this->connection->prepare('SELECT id,nombre,fecha,ganador FROM partida where id_torneo = :idTorneo');
        $statement->bindParam(":idTorneo", $idTorneo);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }
}
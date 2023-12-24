<?php

namespace App\Models;

use App\Models\Model;
use App\DataClasses\Jugador;

class JugadorModel extends Model
{
    public function insertarJugador(Jugador $jugador): bool
    {
        //CREAMOS LAS 3 VARIABLES DE DATOS QUE REPRESENTAN A UN JUGADOR.
        $nombre = $jugador->getNombre();
        $apellidos = $jugador->getApellidos();
        $nick = $jugador->getNick();

        try {
            //PREPARAMOS UNA SENTENCIA SQL.
            $statement = $this->connection->prepare('INSERT INTO JUGADOR(nombre,apellidos,nick) VALUES(:nombre, :apellidos, :nick)');
            //ASGINAMOS PARAMETROS.
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':apellidos', $apellidos);
            $statement->bindParam(':nick', $nick);

            //EJECUTAMOS LA SENTENCIA PREPARADA.
            $statement->execute();
            return true;
        } catch (\PDOException $exception) {
            echo $exception;
            return false;
        }


    }

    public function getPartidasGanadas(int $idTorneo, string $nickJugador): int
    {
        $statement = $this->connection->prepare('SELECT COUNT(id) FROM partida WHERE ganador = :nickJugador and id_torneo = :idTorneo');
        $statement->bindParam(":nickJugador", $nickJugador);
        $statement->bindParam(":idTorneo", $idTorneo);
        $statement->execute();

        if (!$statement->fetch(\PDO::FETCH_NUM)[0]) {
            return 0;
        }
        return $statement->fetch(\PDO::FETCH_NUM)[0];

    }

    public function getJugadores(): array
    {
        $statement = $this->connection->query('SELECT id, nick FROM jugador');

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }
}
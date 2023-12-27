<?php

namespace App\Models;

use App\models\Model;
use App\DataClasses\Torneo;

class TorneoModel extends Model
{
    public function insertarTorneo(Torneo $torneo): bool
    {
        //CREAMOS LAS 3 VARIABLES DE DATOS QUE REPRESENTAN A UN JUGADOR.
        $nombre = $torneo->getNombre();
        $fInicio = $torneo->getFechaInicio();
        $fFin = $torneo->getFechaFin();

        try {
            //PREPARAMOS UNA SENTENCIA SQL.
            $statement = $this->connection->prepare('INSERT INTO TORNEO(nombre,fecha_inicio,fecha_fin) VALUES(:nombre, :fInicio, :fFin)');
            //ASGINAMOS PARAMETROS.
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':fInicio', $fInicio);
            $statement->bindParam(':fFin', $fFin);

            //EJECUTAMOS LA SENTENCIA PREPARADA.
            $statement->execute();
            return true;
        } catch (\PDOException $exception) {
            echo $exception;
            return false;
        }


    }

    public function getTorneos(): array
    {
        $statement = $this->connection->query('SELECT id, nombre,fecha_inicio,fecha_fin FROM torneo');

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public function deleteTorneo($id): bool
    {
        $statement = $this->connection->prepare('DELETE FROM torneo where id = :id');
        $statement->bindParam(":id", $id);
        return $statement->execute();
    }
}
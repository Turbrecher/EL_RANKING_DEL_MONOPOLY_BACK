<?php

namespace App\Models;

use App\Models\Model;
use App\DataClasses\Jugador;

class JugadorModel extends Model
{
    /**
     * Metodo que se encarga de insertar el jugador introducido como parametro
     * en la base de datos.
     * @param Jugador $jugador
     * @return bool
     */
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

    /**
     * Metodo que obtiene todos los jugadores existentes en la base de datos.
     * @return array
     */
    public function getJugadores(): array
    {
        $statement = $this->connection->query('SELECT id, nick FROM jugador');

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * Metodo que comprueba si el jugador con el nick introducido como parametro ya existe.
     * @param string $nick el nick del jugador.
     * @return bool si existe o no.
     */
    public function jugadorExiste(string $nick): bool
    {
        $statement = $this->connection->prepare('SELECT COUNT(id) FROM jugador where nick = :nick');
        $statement->bindParam('nick', $nick);
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_NUM)[0];

        if ($result > 0) {
            return true;
        }


        return false;

    }
}
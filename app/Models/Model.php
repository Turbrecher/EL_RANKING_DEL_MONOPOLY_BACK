<?php

namespace App\Models;

/**
 * Gestiona la conexión de la base de datos e incluye un esquema para
 * un Query Builder. Los return son ejemplo en caso de consultar la tabla
 * usuarios.
 */

use Dotenv;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Model
{
    protected $db_host;
    protected $db_user;
    protected $db_pass;
    protected $db_name;

    protected $connection;

    protected $query; // Consulta a ejecutar

    protected $select = '*';
    protected $where, $values = [];
    protected $orderBy;

    protected $table; // Definido en el hijo

    public function __construct()
    {

        $this->db_host = $_ENV['DB_HOST'];
        $this->db_user = $_ENV['DB_USER'];
        $this->db_pass = $_ENV['DB_PASSWORD'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->connection();
    }

    public function connection()
    {
        $this->connection = new \PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name, $this->db_user, $this->db_pass);
    }


    /*
     * Función que ejecuta una consulta y guarda los datos recibidos en la propiedad query.
     */
    public function query($sql, $data = []): Model
    {
        if ($data) {
            //Preparamos la consulta.
            $statement = $this->connection->prepare($sql);

            //Establecemos los valores de la consulta preparada en un bucle for.
            for ($i = 0; $i < count($data); $i++) {
                $statement->bindParam($i + 1, $data[$i]);
            }

            //Ejecutamos la sentencia preparada.
            $statement->execute();

            //Guardamos en la propiedad query los valores recibidos de la base de datos.
            $this->query = $statement->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $this->query = $this->connection->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $this;
    }

    public function select(...$columns): Model
    {
        // Separamos el array en una cadena con ,
        $this->select = implode(', ', $columns);

        return $this;
    }

    // Devuelve todos los registros de una tabla
    public function all()
    {
        // La consulta sería
        $sql = "SELECT * FROM {$this->table}";
        // Y se llama a la sentencia
        $this->query($sql)->get();
    }

    // Consulta base a la que se irán añadiendo partes
    public function get()
    {
        if (empty($this->query)) {
            $sql = "SELECT {$this->select} FROM {$this->table}";

            // Se comprueban si están definidos para añadirlos a la cadena $sql
            if ($this->where) {
                $sql .= " WHERE {$this->where}";
            }

            if ($this->orderBy) {
                $sql .= " ORDER BY {$this->orderBy}";
            }

            $this->query($sql, $this->values);
        }

    }

    public function between(int $r1,int $r2){
        $sql = "SELECT * FROM {$this->table} WHERE ID BETWEEN ? AND ?";

        $this->query($sql, [$r1,$r2]);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";

        $this->query($sql, [$id]);
    }

    // Se añade where a la sentencia con operador específico
    public function where($column, $operator, $value = null, $chainType = ' and '): Model
    {
        if ($value == null) { // Si no se pasa operador, por defecto =
            $value = $operator;
            $operator = ' = ';
        }

        // Si ya había algo de antes 
        if ($this->where) {
            $this->where .= " {$chainType} {$column} {$operator} ?";
        } else {
            $this->where = "{$column} {$operator} ?";
        }

        $this->values[] = $value;

        return $this;
    }

    // Se añade orderBy a la sentencia
    public function orderBy($column, $order = 'ASC'): Model
    {
        if ($this->orderBy) {
            $this->orderBy .= ", {$column} {$order}";
        } else {
            $this->orderBy = "{$column} {$order}";
        }

        return $this;
    }

    // Insertar, recibimos un $_GET o $_POST
    public function create($data): Model
    {
        $columns = array_keys($data); // array de claves del array
        $columns = implode(', ', $columns); // y creamos una cadena separada por ,

        $values = array_values($data); // array de los valores

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES (" . str_repeat(' ?, ', count($values) - 1) . "?)";

        $this->query($sql, $values);

        return $this;
    }

    public function update($id, $data): Model
    {
        $fields = [];

        foreach ($data as $key => $value) {
            $fields[] = "{$key} = ?";
        }

        $fields = implode(', ', $fields);

        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = ?";

        $values = array_values($data);
        $values[] = $id;

        $this->query($sql, $values);
        return $this;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";

        $this->query($sql, [$id], 'i');
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
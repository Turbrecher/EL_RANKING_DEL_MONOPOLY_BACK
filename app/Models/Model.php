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
    protected string $db_host;
    protected string $db_user;
    protected string $db_pass;
    protected string $db_name;
    protected \PDO $connection;

    public function __construct()
    {

        $this->db_host = $_ENV['DB_HOST'];
        $this->db_user = $_ENV['DB_USER'];
        $this->db_pass = $_ENV['DB_PASSWORD'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->connection();
    }

    public function connection(): void
    {
        $this->connection = new \PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name, $this->db_user, $this->db_pass);
    }

}
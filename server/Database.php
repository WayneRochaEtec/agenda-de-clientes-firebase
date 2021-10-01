<?php

date_default_timezone_set('America/Sao_Paulo');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'pw2_clientes');

class Database {
    private $conn;

    public function __construct(){
        $this->connect();
    }
    private function connect(){
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }
    public function register($name, $phone, $origin, $contact_date, $note){
        $query = "INSERT INTO `agendamentos` (`id`, `nome`, `telefone`, `origem`, `data_contato`, `observação`, `data_de_cadastro`) VALUES (NULL, ?, ?, ?, ?, ?, current_timestamp())";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssss", $name, $phone, $origin, $contact_date, $note);
        return $stmt->execute();
    }
}
?>
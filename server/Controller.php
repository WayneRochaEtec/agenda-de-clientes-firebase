<?php
require_once 'Database.php';

class Controller{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function register($name, $phone, $origin, $contact_date, $note){ 
        $this->db->register($name, $phone, $origin, $contact_date, $note);
    }

    public function update($id, $name, $phone, $origin, $contact_date, $note){ 
        $this->db->update($id, $name, $phone, $origin, $contact_date, $note);
    }
    public function getAllClients(){
        $clients = $this->db->selectAllClients();
        return $clients;
    }

    public function getClient($id){
        $client = $this->db->selectClient($id);
        return $client[0];
    }

    public function deleteClient($id){
        $this->db->deleteClient($id);
    }

    public function redirect($sucess){
        header("location: " . $_SERVER["HTTP_REFERER"] . (($sucess) ? "#success" : "#fail"));
        die();
    }
}

?>
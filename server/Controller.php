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

    public function getAllClients(){
        $clients = $this->db->selectAllClients();
        return $clients;
    }

    public function getAllClientById($id){
        $client = $this->db->selectClient();
        return $client;
    }

    public function convertDateToLocalString($date){
        $formatedDate = date('d-m-Y', strtotime($date));
        return str_replace("-", "/", $formatedDate);
    }

    public function redirect($sucess){
        header("location: " . $_SERVER["HTTP_REFERER"] . (($sucess) ? "#success" : "#fail"));
        die();
    }
}

?>
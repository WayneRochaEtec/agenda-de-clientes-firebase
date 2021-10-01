<?php
require_once 'Database.php';
require_once 'RegisterData.php';

class RegisterController{
    private $db;
    private $registerData;

    public function __construct(){
        $this->db = new Database();
        $this->registerData = new RegisterData();
    }

    public function register(){ 
        try {
            $this->db->register(
                $this->registerData->getName(),
                $this->registerData->getPhone(),
                $this->registerData->getOrigin(),
                $this->registerData->getContact_date(),
                $this->registerData->getNote()
            );
        } catch (\Throwable $e){
            $this->redirect(FALSE);
        }

        $this->redirect(TRUE);
    }
    
    public function redirect($sucess){
        header("location: " . $_SERVER["HTTP_REFERER"] . (($sucess) ? "#success" : "#fail"));
        die();
    }
}

$registerController = new RegisterController();
$registerController->register();

?>
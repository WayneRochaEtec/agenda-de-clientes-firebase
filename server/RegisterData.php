<?php
require_once 'Controller.php';

class RegisterData {
    private $name;
    private $phone;
    private $origin;
    private $contact_date;
    private $note;

    public function __construct(){
        $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $this->setName((isset($_POST["name"])) ? $_POST["name"] : "");
        $this->setPhone((isset($_POST["phone"])) ? $_POST["phone"] : "");
        $this->setOrigin((isset($_POST["origin"])) ? $_POST["origin"] : "");
        $this->setContact_date((isset($_POST["contact_date"])) ? $_POST["contact_date"] : "");
        $this->setNote((isset($_POST["note"])) ? $_POST["note"] : "");

        $controller = new Controller();
        try {
            $controller->register(
                $this->getName(),
                $this->getPhone(),
                $this->getOrigin(),
                $this->getContact_date(),
                $this->getNote()
            );
            $controller->redirect(TRUE);
        } catch (\Throwable $e){
            $controller->redirect(FALSE);
        }
    }

    public function setName($name){
        $this->name = strtolower(trim($name));
    }

    public function getName(){
        return $this->name;
    }

    public function setPhone($phone){
        $this->phone = preg_replace("~\D~", "", trim($phone));
    }

    public function getPhone(){
        return $this->phone;
    }

    public function setOrigin($origin){
        $this->origin = $origin;
    }

    public function getOrigin(){
        return $this->origin;
    }

    public function setContact_date($contact_date){
        $this->contact_date = $contact_date;
    }

    public function getContact_date(){
        return $this->contact_date;
    }

    public function setNote($note){
        $this->note = $note;
    }
    
    public function getNote(){
        return $this->note;
    }
}

new RegisterData();
?>

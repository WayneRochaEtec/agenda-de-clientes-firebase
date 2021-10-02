<?php
require_once 'Controller.php';
require_once 'Utils.php';

$controller = new Controller();
$utils = new Utils();
$id = intval($_GET["id"]);

try {
    $controller->deleteClient($id);
    $controller->redirect(TRUE);
} catch (\Throwable $e){
    $utils->createErrorLog($e);
}

?>
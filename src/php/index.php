<?php 

require_once '../php/config/config_db.php';
require_once '../php/models/centros.php';
require_once '../php/models/clases.php';

if(!isset($_GET["controller"])) $_GET["controller"] = constant("DEFAULT_CONTROLLER");
if(!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");

$controller_path = '../php/controllers/'.$_GET["controller"].'.php';

/* Check if controller exists */
if(!file_exists($controller_path)) $controller_path = 'php/controllers/'.constant("DEFAULT_CONTROLLER").'.php';

/* Load controller */
require_once $controller_path;

$controllerName = 'Controlador'.$_GET["controller"];
$controller = new $controllerName();

/* Check if method is defined */

$dataToView["data"] = array();
if(method_exists($controller,$_GET["action"])) $dataToView["data"] = $controller->{$_GET["action"]}();


/* Load views */
require_once '../php/views/template/header.php';
require_once '../php/views/'.$controller->view.'.php';
require_once '../php/views/template/footer.php';
?>
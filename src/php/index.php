<?php

require_once '../php/config/config_db.php';
require_once '../php/config/config.php';
require_once '../php/models/mCentros.php';
require_once '../php/models/mClases.php';
require_once '../php/models/mNiveles.php';
require_once '../php/models/mConflictos.php';
require_once '../php/models/mPersonajes.php';
require_once '../php/models/mReflexiones.php';

// Si es la primera vez que se llama al index , cojemos el controlador y método por defecto
if(!isset($_GET["controller"])) $_GET["controller"] = constant("DEFAULT_CONTROLLER");
if(!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");

// almacenamos la ruta del controlador
$controller_path = '../php/controllers/'.$_GET["controller"].'.php';

// preguntamos si existe dicho archivo
if(!file_exists($controller_path)) $controller_path = 'php/controllers/'.constant("DEFAULT_CONTROLLER").'.php';

// lo incluimos en el codigo el controlador para poder realizar operaciones con él en el index
require_once $controller_path;

// almacenamos el nombre del controlador y creamos un nuevo objeto de esa clase para operar con el
$controllerName = $_GET["controller"];
$controller = new $controllerName();

$dataToView["data"] = array();
if(method_exists($controller,$_GET["action"])) $dataToView["data"] = $controller->{$_GET["action"]}();

// incluimos la cabecera , la vista que nos llega desde el controlador y por último el footer
require_once '../php/views/template/header.php';
require_once '../php/views/'.$controller->view.'.php';
require_once '../php/views/template/footer.php';

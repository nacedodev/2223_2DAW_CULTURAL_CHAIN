<?php
require_once '../php/config/config_db.php';
require_once '../php/config/config.php';
require_once '../php/models/mCentros.php';
require_once '../php/models/mClases.php';
require_once '../php/models/mNiveles.php';
require_once '../php/models/mConflictos.php';
require_once '../php/models/mPersonajes.php';
require_once '../php/models/mReflexiones.php';

// Si es la primera vez que se llama al index o si a la hora de redireccionar no especificamos el controlador y el método, cojemos el controlador y método por defecto 
if(!isset($_GET["controller"])) $_GET["controller"] = constant("DEFAULT_CONTROLLER");
if(!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");

// almacenamos la ruta del controlador
$ruta_controlador = '../php/controllers/'.$_GET["controller"].'.php';

// preguntamos si existe dicho archivo , si no existe un archivo con esa ruta , se llama a la ruta del controlador por defecto
if(!file_exists($ruta_controlador)) $ruta_controlador = 'php/controllers/'.constant("DEFAULT_CONTROLLER").'.php';

// lo incluimos en el codigo el controlador para poder realizar operaciones con él en el index
require_once $ruta_controlador;

// almacenamos el nombre del controlador y creamos un nuevo objeto de esa clase para operar con el
$nombre_controlador = $_GET["controller"];
$controlador = new $nombre_controlador();

// Almacenamos en $dataToView["data"] la información que nos devuelve el método al que hemos llamado , para poder mostrarlo en la vista
$dataToView["data"] = array();
// $dataToView["data"] no es más que un array que almacena el contenido que devuelven los métodos del controlador , para posteriormente mostrarlos en la vista
if(method_exists($controlador,$_GET["action"])) $dataToView["data"] = $controlador->{$_GET["action"]}();

// incluimos la cabecera , la vista que nos llega desde el controlador y por último el footer
require_once '../php/views/template/header.php';
require_once '../php/views/'.$controlador->view.'.php';
require_once '../php/views/template/footer.php';

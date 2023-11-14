<?php
require '../controllers/centros.php';

$accion = $_GET["accion"];

if ($accion === "aniadir") {
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
    $localidad = isset($_POST["localidad"]) ? $_POST["localidad"] : null;
    
 
        $centrosController = new ControladorCentros();
        $centrosController->aniadirCentro($nombre, $localidad);
        header('Location: centros.php');
    
} elseif ($accion === "modificar") {
    
} elseif ($accion === "borrar") {
    $id =$_GET["id"];
        $centrosController = new ControladorCentros();
        $centrosController->borrarCentros($id);
        header('Location: centros.php');

}
?>

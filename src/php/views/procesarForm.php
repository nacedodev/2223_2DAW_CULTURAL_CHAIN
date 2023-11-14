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
    // Resto del código para "modificar"
} elseif ($accion === "borrar") {
    // Resto del código para "borrar"
}
?>

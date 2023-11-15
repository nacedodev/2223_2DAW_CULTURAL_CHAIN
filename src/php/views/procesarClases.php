<?php
require '../controllers/clases.php';


$accion = $_GET["accion"];

if ($accion === "aniadir") {
    $etapa = isset($_POST["etapa"]) ? $_POST["etapa"] : null;
    $clase = isset($_POST["clase"]) ? $_POST["clase"] : null;
        $clasesController = new ControladorClases();
        $clasesController->aniadirClases($etapa, $clase);
       
        header('Location:  clases.php');
    
} elseif ($accion === "modificar") {
    $id = isset($_POST["id"]) ? $_POST["id"] : null;
    $etapa = isset($_POST["etapa"]) ? $_POST["etapa"] : null;
    $clase = isset($_POST["clase"]) ? $_POST["clase"] : null;

    $clasesController = new ControladorClases();
    $clasesController->modificarCentros($id,$etapa, $clase);
    header('Location  clases.php');
} elseif ($accion === "borrar") {
    $id =$_GET["id"];
    $id = isset($_GET["id"]) ? $_GET["id"] : null;
        $clasesController = new ControladorClases();
        $clasesController->borrarClases($id);
        header('Location  clases.php');

}
?>

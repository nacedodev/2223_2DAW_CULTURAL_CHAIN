<?php
require '../controllers/clases.php';


$accion = $_GET["accion"];
$centro_id = isset($_GET["id"]) ? $_GET["id"] : null;

if ($accion === "aniadir") {
    $etapa = isset($_POST["etapa"]) ? $_POST["etapa"] : null;
    $clase = isset($_POST["clase"]) ? $_POST["clase"] : null;
   
    
    $clasesController = new ControladorClases();
    $clasesController->aniadirClases($etapa, $clase, $centro_id);
    
    // Redirige después de agregar clases
    header("Location: clases.php?id=$centro_id");
    
} elseif ($accion === "modificar") {
    $id = isset($_POST["id"]) ? $_POST["id"] : null;
    $etapa = isset($_POST["etapa"]) ? $_POST["etapa"] : null;
    $clase = isset($_POST["clase"]) ? $_POST["clase"] : null;

    $clasesController = new ControladorClases();
    $clasesController->modificarCentros($id,$etapa, $clase);
    header("Location: clases.php?id=$centro_id");
} elseif ($accion === "borrar") {
    $id =$_GET["id"];
    $id = isset($_GET["id"]) ? $_GET["id"] : null;
        $clasesController = new ControladorClases();
        $clasesController->borrarClases($id);
        header("Location: clases.php?id=$centro_id");

}
?>

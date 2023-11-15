<?php
require '../controllers/clases.php';


$accion = $_GET["accion"];
$centro_id = isset($_GET["id"]) ? $_GET["id"] : null;

if ($accion === "aniadir") {
    $etapa = isset($_POST["etapa"]) ? $_POST["etapa"] : null;
    $clase = isset($_POST["clase"]) ? $_POST["clase"] : null;
   
    
    $clasesController = new ControladorClases();
    $clasesController->aniadirClases($etapa, $clase, $centro_id);
    

    header("Location: clases.php?id=$centro_id");
    
} elseif ($accion === "modificar") {
    $id = isset($_POST["id"]) ? $_POST["id"] : null;
    $etapa = isset($_POST["etapa"]) ? $_POST["etapa"] : null;
    $clase = isset($_POST["clase"]) ? $_POST["clase"] : null;

    $clasesController = new ControladorClases();
    $clasesController->modificarCentros($id,$etapa, $clase);
    header("Location: clases.php?id=$centro_id");
} elseif ($accion === "borrar") {
    $id = isset($_GET["id"]) ? $_GET["id"] : null;
    $centro_id = isset($_GET["id_centro"]) ? $_GET["id_centro"] : null;

    echo "ID de la clase a borrar: $id<br>";
    echo "ID del centro asociado: $centro_id<br>";

    $clasesController = new ControladorClases();
    $resultadoBorrado = $clasesController->borrarClases($id);

    
        echo "Clase borrada correctamente.";
        header("Location: clases.php?id=$centro_id");
   
}
?>

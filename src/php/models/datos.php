<?php

$datos = array(
    "nombre" => "Ejemplo",
    "mensaje" => "¡Hola, este es un ejemplo!"
);

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($datos);

?>

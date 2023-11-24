<?php
    // tu_archivo_ajax.php

    // Incluir el modelo y el controlador
    include('centros.php');
    // Crear una instancia del controlador
    $controlador = new Centro();

    // Obtener datos desde la base de datos utilizando el controlador
    $datos = $controlador->listar();  // Ajusta el nombre del método según tu lógica

    // Devolver los datos como respuesta JSON
    header('Content-Type: application/json');
    echo json_encode($datos);
?>

<?php 
require_once 'config/config_db.php';
$conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);
$conexion->set_charset("utf8mb4");

// Realiza la consulta a la base de datos (reemplaza con tu consulta
$query = "SELECT * FROM Personaje";
$resultado = $conexion->query($query);

// Procesa los resultados y devuelve un array en formato JSON
$data = array();
while ($fila = $resultado->fetch_assoc()) {
    // Obtener la imagen como un string binario (mediumblob)
    $imageData = $fila['imagenPersonaje'];

    // Convertir la imagen binaria a base64
    $base64Image = base64_encode($imageData);

    // Incluir el campo de la imagen en el objeto otherData
    $otherData = array(
        'nombre' => $fila['nombre'],
        'imagen' => $base64Image,
    );

    $responseData = array(
        'otherData' => $otherData,
    );

    // Agregar los datos al array principal
    $data[] = $responseData;
}

// Cierra la conexión a la base de datos
$conexion->close();

// Devuelve los datos en formato JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data, JSON_UNESCAPED_UNICODE);
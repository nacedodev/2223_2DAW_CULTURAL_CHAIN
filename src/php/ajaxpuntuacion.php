<?php
require_once 'config/config_db.php';

// Verifica si la solicitud es de tipo POST y si hay datos en el cuerpo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    // Verifica si los datos JSON son válidos
    if ($data === null) {
        echo json_encode(array("status" => "error", "message" => "Datos JSON no válidos"));
        exit;
    }

    // Conecta a la base de datos
    $conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);
    $conexion->set_charset("utf8mb4");

    // Verifica la conexión
    if ($conexion->connect_error) {
        echo json_encode(array("status" => "error", "message" => "Error de conexión: " . $conexion->connect_error));
        exit;
    }

    // Recupera los datos del formulario
    $nickname = $data['nickname'];
    $centro = $data['centro'];
    $correo = $data['correo'];
    $localidad = $data['localidad'];
    $cp = $data['cp'];
    $puntuacion = $data['puntuacion'];

    // Construye la consulta SQL
    $query = "INSERT INTO Puntuacion (nickname, Centro, email, localidad, codigo_postal, puntuacion) VALUES ('$nickname', '$centro', '$correo', '$localidad', '$cp', '$puntuacion')";

    // Ejecuta la consulta
    if ($conexion->query($query) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Registro insertado correctamente"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error al insertar el registro: " . $conexion->error));
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
} else {
    echo json_encode(array("status" => "error", "message" => "Método de solicitud no permitido"));
}
?>
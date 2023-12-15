<?php 
require_once 'config/config_db.php';

// Conecta a la base de datos
$conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);
$conexion->set_charset("utf8mb4");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recupera los datos del formulario (ajusta esto según la estructura de tu formulario)
$nickname = $_POST['nickname'];
$centro = $_POST['centro'];
$correo = $_POST['correo'];
$localidad = $_POST['localidad'];
$cp = $_POST['cp'];

// Construye la consulta SQL (ajusta los nombres de las columnas según tu tabla)
$query = "INSERT INTO Puntuacion (nickname, Centro, email, localidad, codigo_postal,puntuacion) VALUES ('$nickname', '$centro', '$correo', '$localidad', '$cp','10')";

// Ejecuta la consulta
if ($conexion->query($query) === TRUE) {
    echo "Registro insertado correctamente";
} else {
    echo "Error al insertar el registro: " . $conexion->error;
}

// Cierra la conexión a la base de datos
$conexion->close();
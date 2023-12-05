<?php 
require_once 'config/config_db.php';
$conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);
$conexion->set_charset("utf8mb4");

// Realiza la consulta a la base de datos (reemplaza con tu consulta
$query = "SELECT * FROM Nivel";
$resultado = $conexion->query($query);

// Procesa los resultados y devuelve un array en formato JSON
$data = array();
while ($fila = $resultado->fetch_assoc()) {
    // Obtener la imagen como un string binario (mediumblob)
    $imageData = $fila['imagen'];

    // Convertir la imagen binaria a base64
    $base64Image = base64_encode($imageData);

    // Incluir el campo de la imagen en el objeto otherData
    $otherData = array(
        'nombrepais' => $fila['nombrepais'],
        'imagen' => $base64Image,
    );

    // Obtener los conflictos asociados al nivel
    $nivelId = $fila['id']; // Reemplaza 'id' con el nombre correcto de tu columna de ID
    $conflictos = obtenerConflictos($conexion, $nivelId);
    $reflexiones = obtenerReflexiones($conexion, $nivelId);

    // Agregar los conflictos al array $otherData
    $otherData['conflictos'] = $conflictos;
    $otherData['reflexiones'] = $reflexiones;

    // Crear un array con todos los datos que deseas devolver
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

// Función para obtener conflictos asociados a un nivel específico
function obtenerConflictos($conexion, $nivelId) {
    $query = "SELECT * FROM Conflicto WHERE nivel_id = $nivelId"; // Reemplaza 'nivel_id' con el nombre correcto de tu columna de ID de nivel en la tabla Conflictos
    $resultado = $conexion->query($query);

    $conflictos = array();
    while ($conflicto = $resultado->fetch_assoc()) {
        // Procesa los datos del conflicto según tus necesidades
        $conflictos[] = array(
            'nombre' => utf8_encode($conflicto['nombreconflicto']),
            'x' => $conflicto['posx'],
            'y' => $conflicto['posy'],
        );
    }

    return $conflictos;
}

// Función para obtener reflexiones asociadas a un nivel específico
function obtenerReflexiones($conexion, $nivelId) {
    $query = "SELECT * FROM Reflexion WHERE nivel_id = $nivelId"; // Reemplaza 'nivel_id' con el nombre correcto de tu columna de ID de nivel en la tabla Reflexiones
    $resultado = $conexion->query($query);

    if (!$resultado) {
        die('Error en la consulta SQL: ' . $conexion->error);
    }

    $reflexiones = array();
    while ($reflexion = $resultado->fetch_assoc()) {
        // Procesa los datos de la reflexion según tus necesidades
        $reflexiones[] = array(
            'titulo' => $reflexion['titulo'],
            'contenido' => $reflexion['contenido'],
        );
    }
    return $reflexiones;
}
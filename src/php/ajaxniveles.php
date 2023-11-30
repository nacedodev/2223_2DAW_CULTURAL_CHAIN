<?php 
require_once 'config/config_db.php';
$conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);

// Realiza la consulta a la base de datos (reemplaza con tu consulta)
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

    // Agregar los conflictos al array $otherData
    $otherData['conflictos'] = $conflictos;

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
header('Content-Type: application/json');
echo json_encode($data);

// Función para obtener conflictos asociados a un nivel específico
function obtenerConflictos($conexion, $nivelId) {
    $query = "SELECT * FROM Conflicto WHERE nivel_id = $nivelId"; // Reemplaza 'nivel_id' con el nombre correcto de tu columna de ID de nivel en la tabla Conflictos
    $resultado = $conexion->query($query);

    $conflictos = array();
    while ($conflicto = $resultado->fetch_assoc()) {
        // Procesa los datos del conflicto según tus necesidades
        $conflictos[] = array(
            'nombre' => $conflicto['nombreconflicto'],
            'x' => $conflicto['posx'],
            'y' => $conflicto['posy'],
            // Agrega más campos según sea necesario
        );
    }

    return $conflictos;
}
?>
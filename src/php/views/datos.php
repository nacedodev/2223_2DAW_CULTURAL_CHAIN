<?php


$datos = new Centro();
$datosCentros = [];

// Llamar al método listarCentros para obtener los datos
$datosCentros = $datos->listar();
print_r($datosCentros);
// Mostrar los datos por consola
?>

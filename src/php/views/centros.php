<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>centros</title>
</head>
<body>
    
<h2>Tabla - Centro</h2>
<a href="aniadirCentros.php"><button>Añadir</button></a>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Dirección</th>
        
    </tr>
    <?php 
    require_once '../controllers/centros.php';

    $centrosController = new ControladorCentros();
    $centros = $centrosController->listarCentros(); 
    
foreach ($centros as $centro) {
?>
    <tr>
        <td><?php echo $centro['id']; ?></td>
        <td><?php echo $centro['nombre']; ?></td>
        <td><?php echo $centro['localidad']; ?></td>
        <td>
          
            <button>Borrar</button>
            <button>Modificar</button>
            <button>Clases</button>
        </td>
    </tr>
<?php
}
?>

</table>

</body>
</html>

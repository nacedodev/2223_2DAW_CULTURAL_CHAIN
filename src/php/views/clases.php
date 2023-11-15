<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>clases</title>
</head>
<body>
    
<h2>Tabla - clase</h2>
<?php   $centro_id = isset($_GET['id']) ? $_GET['id'] : null;?>
<a href="aniadirClases.php?id=<?php echo $centro_id; ?>"><button>Añadir</button></a>
<table>
    <tr>
        <th>ID</th>
        <th>etapa</th>
        <th>clase</th>
       
    </tr>
    <?php 
    require_once '../controllers/clases.php';
  
    $clasesController = new ControladorClases();
    $clases = $clasesController->listarClases($centro_id); 
    
foreach ($clases as $clase) {
?>
    <tr>
        <td><?php echo $clase['id']; ?></td>
        <td><?php echo $clase['etapa']; ?></td>
        <td><?php echo $clase['clase']; ?></td>
        <td>
          
        <a href="procesarClases.php?accion=borrar&id=<?php echo $clase['id']; ?>&id_centro=<?php echo $centro_id; ?>"><button>Borrar</button></a>


        <a href="modificarclases.php?accion=modificar&id=<?php echo $clase['id']; ?>&nombre=<?php echo ($clase['etapa']); ?>&localidad=<?php echo ($clase['clase']); ?>">
             <button>Modificar</button>
        </a>
        </td>
        </td>
    </tr>
<?php
}
?>

</table>

</body>
</html>

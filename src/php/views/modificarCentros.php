<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aniadir</title>
</head>
<body>
<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$localidad = isset($_GET['localidad']) ? $_GET['localidad'] : '';
?>

<form method="POST" action="procesarCentros.php?accion=modificar">
    <label for="ip">IP:</label>
    <input  readonly type="text" name="id" value="<?php echo $id; ?>">
    <label for="nombre">nombre:</label>
    <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>

    <label for="localidad">localidad:</label>
    <input type="text" name="localidad" value="<?php echo $localidad; ?>"><br>

    <input type="submit">
</form>

</body>
</html>
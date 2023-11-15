<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aniadir</title>
</head>
<body>
<form id="formularioCentro" name="formularioCentro" action="procesarCentros.php?accion=aniadir" method="post">

<label for="nombre">Nombre del Centro:</label>
<input type="text" id="nombre" name="nombre" required>

<label for="localidad">Localidad:</label>
<input type="text" id="localidad" name="localidad" required>

    <input type="submit">
</form>

</body>
</html>
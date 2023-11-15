<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aniadir</title>
</head>
<body>


<?php
    $centro_id = isset($_GET['id']) ? $_GET['id'] : null;
    ?>
<form id="formularioClases" name="formularioClases" action="procesarClases.php?accion=aniadir&id=<?php echo $centro_id; ?>" method="post">
    <input type="hidden" name="centro_id" value="<?php echo $centro_id; ?>">
<label for="etapa">etapa:</label>
<input type="text" id="etapa" name="etapa" required>

<label for="clase">clase:</label>
<input type="text" id="clase" name="clase" required>


    <input type="submit">
</form>

</body>
</html>
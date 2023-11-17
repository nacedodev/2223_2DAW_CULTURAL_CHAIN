
<form id="formularioCentro" name="formularioCentro" action="admin.php?action=modificarCentro&controller=Centros" method="post">

<label for="nombre">Nombre del Centro:</label>
<input type="text" id="nombre" name="nombre" value="<?php echo isset($_GET['nombre']) ? $_GET['nombre'] : ''; ?>" required>

<label for="localidad">Localidad:</label>
<input type="text" id="localidad" name="localidad" value="<?php echo isset($_GET['localidad']) ? $_GET['localidad'] : ''; ?>" required>

<!-- Agrega un campo oculto para pasar el ID -->
<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">

<input type="submit">
</form>

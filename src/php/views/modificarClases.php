
<form id="formularioClases" name="formularioClases" action="admin.php?action=modificarClases&controller=Clases" method="post">

<label for="etapa">etapa:</label>
<input type="text" id="etapa" name="etapa" value="<?php echo isset($_GET['etapa']) ? $_GET['etapa'] : ''; ?>" required>
<input type="hidden" name="centro_id" value="<?php echo $_GET['centro_id']; ?>">
<label for="clase">clase:</label>
<input type="text" id="clase" name="clase" value="<?php echo isset($_GET['clase']) ? $_GET['clase'] : ''; ?>" required>

<!-- Agrega un campo oculto para pasar el ID -->
<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">

<input type="submit">
</form>

<div id="vistaForm">
    <form id="formularioCentro" name="formularioCentro" action="index.php?action=modificarNivel&controller=Niveles" method="post">

    <label for="nombre">Nombre del Nivel:</label>
    <input type="text" id="nombrepais" name="nombrepais" value="<?php echo isset($_GET['nombrepais']) ? $_GET['nombrepais'] : ''; ?>" required>

    <!-- Agrega un campo oculto para pasar el ID -->
    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">

    <input type="submit">
    </form>
</div>
<div id="vistaForm">
    
    <form id="formularioCentro" enctype="multipart/form-data" name="formularioCentro" action="index.php?action=modificarNivel&controller=Niveles" method="post">
    <label for="nombre">Nombre del Nivel:</label>
    <input type="text" id="nombrepais" name="nombrepais" value="<?php echo isset($_GET['nombrepais']) ? $_GET['nombrepais'] : ''; ?>" required>
    <img id="imagenmodificar" src="data:image/png;base64,<?php $nivel = new Nivel(); echo $nivel->obtenerImagenPorId($_GET['id']);?>">
    
    <label for="imagen">Nueva imagen de fondo:</label>
    <input type="file" id="imagen" name="imagen">
    
    <!-- Agrega un campo oculto para pasar el ID -->
    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
    <input type="submit">
    </form>
</div>
<script type="module" src="../js/views/vistaFormNiveles.js"></script>
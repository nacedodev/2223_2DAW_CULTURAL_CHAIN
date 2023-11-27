<div id="vistaForm">
    <form id="form-end" enctype="multipart/form-data" name="formularioCentro" action="index.php?action=modificarNivel&controller=niveles" method="post">
    <label for="nombre">Nombre del Nivel:</label>
    <input type="text" id="nombrepais" name="nombrepais" value="<?php echo isset($_GET['nombrepais']) ? $_GET['nombrepais'] : ''; ?>" required>
    <img id="imagenmodificar" style="width: 100%;" src="data:image/png;base64,<?php $nivel = new Nivel(); echo $nivel->obtenerImagenPorId($_GET['id']);?>">
    <span id="centro-error" class="error-message"></span><br><br>

    <label for="imagen">Nueva imagen de fondo:</label>
    <input type="file" id="imagen" name="imagen">
    
    <!-- Agrega un campo oculto para pasar el ID -->
    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
    <span id="localidad-error" class="error-message"></span><br><br>
        <button id="send" type="submit">Enviar</button>
    <span id="status-message" style="margin-left: 100px;"></span>
    </form>
</div>
<script type="module" src="../js/views/vistaFormNivelesModificar.js"></script>
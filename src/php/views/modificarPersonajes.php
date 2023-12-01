<div id="vistaForm">
    <form id="form-end" enctype="multipart/form-data" name="formularioCentro" action="index.php?action=modificarPersonajes&controller=personajes" method="post">
    <label for="nombre">Nombre del Personaje:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo isset($_GET['nombre']) ? $_GET['nombre'] : ''; ?>" required>
    <img id="imagenmodificar" style="width: 100%;" src="data:image/png;base64,<?php $personaje = new Personaje(HOST,USER,PASSWORD,DATABASE, CHARSET); echo $personaje->obtenerImagenPorId($_GET['id']);?>">
    <span id="centro-error" class="error-message"></span><br><br>

    <label for="pais">País:</label>
    <input type="text" id="pais" name="pais" value="<?php echo isset($_GET['pais']) ? $_GET['pais'] : ''; ?>">
    <span id="centro-error" class="error-message"></span><br><br>

    <label for="imagenPersonaje">Nueva apariencia para el personaje:</label>
    <input type="file" id="imagenPersonaje" name="imagenPersonaje">
    
    <!-- Agrega un campo oculto para pasar el ID -->
    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
    <span id="localidad-error" class="error-message"></span><br><br>
        <button id="send" type="submit">Enviar</button>
    <span id="status-message" style="margin-left: 100px;"></span>
    </form>
</div>
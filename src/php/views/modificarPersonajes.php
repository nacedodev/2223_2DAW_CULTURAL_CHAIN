    <?php if(isset($_GET['mensaje'])): ?>
        <p id="error-edit"><?php echo $_GET['mensaje']; ?></p>
    <?php endif; ?>
    <form style="background-color:transparent" enctype="multipart/form-data" name="formularioCentro" action="index.php?action=modificarPersonajes&controller=personajes" method="post" id="form-edit-personajes">
    <figure class="figure-container" data-image="">
            <img src="data:image/png;base64,<?php $imagen = new Personaje(HOST,USER,PASSWORD,DATABASE, CHARSET); echo $imagen->obtenerImagenPorId($_GET['id']);?>" class="personaje">
            <input type="file" class="file-input" id="imagenPersonaje" name="imagenPersonaje">
            <input type="text" id="nombre" name="nombre" value="<?php echo isset($_GET['nombre']) ? $_GET['nombre'] : ''; ?>" required>
            <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            <button type="submit" id="send-figure"><img style="position:absolute;top:15%;left:18%;" width="70%" src="../img/iconos/send.png" alt=""></button>
    </figure>
    </form>
    <script type="module" src="../js/views/vistamodificarpersonajes.js"></script>
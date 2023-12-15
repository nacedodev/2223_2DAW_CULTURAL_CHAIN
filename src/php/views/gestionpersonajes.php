<?php if(isset($_GET['mensaje'])): ?> <!-- Si nos llega algún tipo de mensaje desde el controlador , lo mostramos-->
        <p id="error-edit"><?php echo $_GET['mensaje']; ?></p>
    <?php endif; ?>
<form enctype="multipart/form-data" style="background: transparent;" action="index.php?action=gestionarPersonajes&controller=personajes" method="post" id="form-personajes">
  <div id="figures-container">
          <?php foreach ($dataToView['data'] as $personaje) : ?>
              <figure class="figure-container" data-image="">
                  <img src="data:image/png;base64,<?php $imagen = new mPersonaje(HOST,USER,PASSWORD,DATABASE, CHARSET); echo $imagen->obtenerImagenPorId($personaje['id']);?>" class="personaje" name="imagenPersonajes[]">
                  <input type="text" value="<?php echo $personaje['nombre']; ?>" class="personaje-input" readonly>
                  <input type="hidden" value="<?php echo $personaje['id'] ?>">
                  <button class="delete-button" type="button">-</button>
                  <button class="edit-button" type="button" onclick="window.location.href = 'index.php?controller=personajes&action=modificarPersonajes&id=<?php echo $personaje['id']?>&nombre=<?php echo $personaje['nombre'] ?>'"><img width="85%"src="../img/iconos/edit.png" style="pointer-events:none" alt="/"></button>
              </figure>
          <?php endforeach; ?>
        <figure id="add-btn">
            <button id="addButton"type='button'><img src="../img/iconos/aniadir.png" alt="+"></button>
            <button id="sendButton" type="submit">ENVIAR</button>
            <button id="revertFigures" type="button" style="display:none;" onclick="window.location.href = 'index.php?controller=personajes&action=gestionarPersonajes'"><img src="../img/iconos/undo.png" alt="<-"></button>
            <button id="deleteFigures" type="button" style="display:none;">BORRAR</button>
        </figure>
  </div>
</form>
<script type="module" src="../js/views/vistapersonajes.js"></script>
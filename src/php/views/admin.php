      <p id="hora"></p>
      <div id="log">
        <?php if(isset($_GET['reflexiones']) && $_GET['reflexiones'] !== ''): ?>
          <p id="text-reflexiones"><?php echo $_GET['reflexiones']; ?></p>
        <?php endif; ?>

        <?php if(isset($_GET['mensajes'])): ?>
          <?php if(is_array($_GET['mensajes'])): ?>
            <?php foreach ($_GET['mensajes'] as $mensaje): ?>
              <p id="mensaje"><?php echo $mensaje; ?></p>
            <?php endforeach; ?>
          <?php else: ?>
            <p id="mensaje"><?php echo $_GET['mensajes']; ?></p>
          <?php endif; ?>
        <?php endif; ?> 
      </div>
      <p id="admin">BIENVENIDO AL PANEL DE ADMINISTRACIÓN</p> 
      <p id="informacion">SELECCIONA UNA CATEGORÍA PARA GESTIONARLA</p>
      <?php if(isset($_GET['estado'])) : ?>
        <p id="text-estado"><?php echo $_GET['estado']; ?></p>
        <?php 
        $longitudMensaje = strlen($_GET['estado']);
        $longitudMensaje == 47 ? $glow = 'filter:drop-shadow(0 0 0.8em #f44d4d);': $glow = 'filter:drop-shadow(0 0 0.8em #90EE90);';
        $longitudMensaje == 47 ? $color = 'color: #f44d4d': $color = 'color: #90EE90;';
        ?>
    <?php endif; ?>
      <p id="dot" style="<?php echo $glow; echo $color;?>">•</p>
      <button style="<?php echo $glow; ?>  box-shadow: 4px 4px 4px 0px rgba(0, 0, 0, 0.25);"id="verificar"> VERIFICAR WEB </button>
      <p data-shadow = 'CULTURAL CHAIN' id="nombreapp">CULTURAL CHAIN</p>
      <script type="module" src="../js/views/vistapanel.js"></script>

<!-- Mostrar la hora -->
<p id="hora"></p>

<div id="log">
  <!-- Si existe 'reflexiones' y tiene contenido, muestra su valor -->
  <?php if(isset($_GET['reflexiones']) && $_GET['reflexiones'] !== ''): ?>
    <p id="text-reflexiones"><?php echo $_GET['reflexiones']; ?></p>
  <?php endif; ?>

  <!-- Si existe 'mensajes' -->
  <?php if(isset($_GET['mensajes'])): ?>
    <!-- Si 'mensajes' es un array, muestra cada mensaje -->
    <?php if(is_array($_GET['mensajes'])): ?>
      <?php foreach ($_GET['mensajes'] as $mensaje): ?>
        <p id="mensaje"><?php echo $mensaje; ?></p>
      <?php endforeach; ?>
    <!-- Si 'mensajes' no es un array, muestra el único mensaje -->
    <?php else: ?>
      <p id="mensaje"><?php echo $_GET['mensajes']; ?></p>
    <?php endif; ?>
  <?php endif; ?> 
</div>

<!-- Mensaje de bienvenida al panel de administración -->
<p id="admin">BIENVENIDO AL PANEL DE ADMINISTRACIÓN</p>
<p id="informacion">SELECCIONA UNA CATEGORÍA PARA GESTIONARLA</p>

<!-- Si existe 'estado' , muestra su valor y le da estilos -->
<?php if(isset($_GET['estado'])) : ?>
  <p id="text-estado"><?php echo $_GET['estado']; ?></p>
  <?php 
  // Se le da estilos dependiendo de su longitud
  $longitudMensaje = strlen($_GET['estado']);
  $longitudMensaje == 47 ? $glow = 'filter:drop-shadow(0 0 0.8em #f44d4d);' : $glow = 'filter:drop-shadow(0 0 0.8em #90EE90);';
  $longitudMensaje == 47 ? $color = 'color: #f44d4d' : $color = 'color: #90EE90;';
  ?>
<?php endif; ?>

<!-- Punto estilizado, su color y sombra son dinámicos -->
<p id="dot" style="<?php echo $glow; echo $color;?>">•</p>

<!-- Botón para verificar la web con estilos dinámicos -->
<button style="<?php echo $glow; ?> box-shadow: 4px 4px 4px 0px rgba(0, 0, 0, 0.25);" id="verificar"> VERIFICAR WEB </button>

<!-- Nombre de la aplicación -->
<p data-shadow='CULTURAL CHAIN' id="nombreapp">CULTURAL CHAIN</p>

<!-- Script para el comportamiento de la vista usando JavaScript -->
<script type="module" src="../js/views/vistapanel.js"></script>

      <style>
        #text-estado{
          color: var(--terciary);
          text-align: center;
          font-family: 'Poppins',sans-serif;
          position:absolute;
          bottom:7%;
          left: 50%;
          transform: translate(-50%,0);
          text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }
        #log{
          position: absolute;
          left:50%;
          top:42%;
          transform: translate(-50%,50%);
        }
        #text-reflexiones{
          color: var(--terciary);
          text-align: center;
          font-family: 'Poppins',sans-serif;
          text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }
        #mensaje{
          color: var(--terciary);
          text-align: center;
          font-family: 'Poppins',sans-serif;
          text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }
        #dot{
          text-align: center;
          font-size: 2vw;
          position:absolute;
          left:50%;
          bottom:18%;
          transform: translate(-50%,0);
          visibility: hidden;
        }
      </style>
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
      <button style="<?php echo $glow; ?>  box-shadow: 4px 4px 4px 0px rgba(0, 0, 0, 0.25);"id="verificar" onclick="redireccionar()"> VERIFICAR WEB </button>
      <p data-shadow = 'CULTURAL CHAIN' id="nombreapp">CULTURAL CHAIN</p>
      <script>
        const dot = document.getElementById('dot');
  const mostrarHora = () => {
    const hora = document.getElementById('hora');
    const fecha = new Date();
    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();

    // Asegúrate de que los números siempre tengan dos dígitos
    if (horas < 10) horas = '0' + horas;
    if (minutos < 10) minutos = '0' + minutos;

    const horaActual = horas + ':' + minutos;

    // Actualiza el contenido del elemento HTML con la hora actual
    hora.innerHTML = horaActual;
  };

  setInterval(mostrarHora, 1000);
  mostrarHora();
  function redireccionar() {
    // Reemplaza el enlace con tu URL deseada
    window.location.href = 'index.php?controller=administracion&action=verificarWeb';
  }
  const adminParagraph = document.getElementById('admin');
  const infoParagraph = document.getElementById('informacion');
  const reflexionesParagraph = document.getElementById('text-reflexiones');
  const estadoP = document.getElementById('text-estado');
  
  
  // Verificar si el elemento 'text-reflexiones' existe
  if (reflexionesParagraph) {
    // Ocultar los párrafos 'admin' e 'informacion' si existe 'text-reflexiones'
  adminParagraph.style.display = 'none';
  infoParagraph.style.display = 'none';
}

if(estadoP){
  dot.style.visibility = 'visible'
}
</script>


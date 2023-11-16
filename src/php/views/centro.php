<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CulturalChain</title>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body id="vistaCentro">
        <img id="logo" src="img/iconos/logo.jpeg">
        <button class="boton">
            <img src="img/iconos/sol.png">
        </button>
        <p class="tituloranking">CENTRO</p>
        <div id="panelCentro">
           <div>
        
                <p>CENTRO</p>
                <a href="aniadirCentros.php"><button id="aniadircentro"><p>+</p></button></a>
           </div>
           <div>
           <?php 
    require_once '../controllers/centros.php';

    $centrosController = new ControladorCentros();
    $centros = $centrosController->listarCentros(); 
    
    foreach ($centros as $centro) {
    ?>
                <div>  
                     
                    <p><?php echo $centro['nombre']; ?></p>
                    <p><?php echo $centro['localidad']; ?></p>
                    <a href="clases.php?accion=clases&id=<?php echo $centro['id']; ?>"><p>></p></a> 
                    <a href="modificarCentros.php?accion=modificar&id=<?php echo $centro['id']; ?>&nombre=<?php echo ($centro['nombre']); ?>&localidad=<?php echo ($centro['localidad']); ?>"><p>M</p></a>
                    <a href="procesarCentros.php?accion=borrar&id=<?php echo $centro['id']; ?>"><img src="img/iconos/basura.png"></a>
              
                </div>
                <?php
}
?>
           </div>
        </div>
        <p id="botonatras"><a href="inicio.html">ATRAS</a></p>
    </body>
</html>
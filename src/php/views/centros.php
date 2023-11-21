<img id="logo" src="../img/iconos/logo.jpeg">
        <button class="boton" id="theme">
            <img src="../img/iconos/sol.png">
        </button>
        <p class="tituloranking" style="margin-top:30px">CENTRO</p>
        <div id="panelCentro">
           <div>
        
                <p>CENTRO</p>
                <a href="index.php?action=aniadirCentro&controller=Centros"><button id="aniadircentro"><p>+</p></button></a>
           </div>
           <div>
    <?php 
        foreach ($dataToView["data"] as $centro) {
    ?>
                <div>
                    <p><?php echo $centro['nombre']; ?></p>
                    <p><?php echo $centro['localidad']; ?></p>
                    <a href="index.php?controller=Clases&action=listarClases&centro_id=<?php echo $centro['id']; ?>&centronombre=<?php echo $centro['nombre']; ?>"><p>></p></a> 
                    <a href="index.php?action=modificarCentro&controller=Centros&id=<?php echo $centro['id']; ?>&nombre=<?php echo $centro['nombre']; ?>&localidad=<?php echo $centro['localidad']; ?>"><img style="margin-left:15px;" src="../img/iconos/edit.png"></a>


                    <a href="index.php?action=borrarCentro&controller=Centros&id=<?php echo $centro['id']; ?>&nombre=<?php echo $centro['nombre']; ?>"><img src="../img/iconos/basura.png"></a>
                </div>
    <?php
        }
    ?>
           </div>
        </div>
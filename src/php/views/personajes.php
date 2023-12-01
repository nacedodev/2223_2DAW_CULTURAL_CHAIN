<div id="panelCentro">
           <div>
                <p>PERSONAJES</p>
                <a href="index.php?action=aniadirPersonajes&controller=personajes"><button id="aniadircentro"><p>+</p></button></a>
           </div>
           <div>
    <?php 
        foreach ($dataToView["data"] as $personaje) {
    ?>
                <div>
                    <p><?php echo $personaje['nombre']; ?></p>
                    <p><?php echo $personaje['pais']; ?></p>
                    <a href="index.php?action=modificarPersonajes&controller=personajes&id=<?php echo $personaje['id']; ?>&nombre=<?php echo $personaje['nombre']; ?>&pais=<?php echo $personaje['pais']; ?>"><img style="margin-left:15px;" src="../img/iconos/edit.png"></a>
                    <a href="index.php?action=borrarPersonaje&controller=personajes&id=<?php echo $personaje['id']; ?>&nombre=<?php echo $personaje['nombre']; ?>"><img src="../img/iconos/basura.png"></a>
                </div>
    <?php
        }
    ?>
           </div>
        </div>
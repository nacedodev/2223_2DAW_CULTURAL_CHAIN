        <div id="panelCentro">
           <div>
                <p>NIVELES</p>
                <a href="index.php?action=aniadirNivel&controller=niveles"><button id="aniadirnivel"><p>+</p></button></a>
           </div>
           <div>
    <?php
        foreach ($dataToView["data"] as $nivel) {
            $imgReflexiones = $nivel['tieneReflexiones'] ? "../img/iconos/libro.png" : "../img/iconos/libro-error.png";
            $imgEstilos = $nivel['tieneReflexiones'] ? " ": "filter: drop-shadow(0 0 10px red)";
    ?>
                <div>
                    <p><?php echo $nivel['nombrepais']; ?></p>
                    <a href="index.php?controller=conflictos&action=listarConflictos&nivel_id=<?php echo $nivel['id']; ?>&nombrepais=<?php echo $nivel['nombrepais']; ?>"><p>></p></a>
                    <a href="index.php?controller=reflexiones&action=gestionarReflexiones&nivel_id=<?php echo $nivel['id'];?>&nombrepais=<?php echo $nivel['nombrepais'];?>"><img style='margin-left:15px;<?php echo $imgEstilos ?>' src="<?php echo $imgReflexiones;?>"></a>
                    <a href="index.php?action=modificarNivel&controller=niveles&id=<?php echo $nivel['id']; ?>&nombrepais=<?php echo $nivel['nombrepais']; ?>"><img style="margin-left:15px;" src="../img/iconos/edit.png"></a>
                    <a href="index.php?action=borrarNivel&controller=niveles&id=<?php echo $nivel['id']; ?>&nombrepais=<?php echo $nivel['nombrepais']; ?>"><img src="../img/iconos/basura.png"></a>
                </div>
    <?php
        }
    ?>
           </div>
        </div>
        <div style="display: flex; align-items: center; position:absolute; bottom:7%;left:50%;transform:translate(-50%,0);filter:drop-shadow(0 0 10px black)">
            <p style="color: var(--terciary)">LOS NIVELES SIN REFLEXIONES ASIGNADAS APARECERÁN CON EL ICONO</p>
            <img width='40px' style="margin-left: 15px; filter: drop-shadow(0 0 10px red)" src="../img/iconos/libro-error.png" alt="">
        </div>


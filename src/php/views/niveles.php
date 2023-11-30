        <div id="panelCentro">
           <div>
                <p>NIVELES</p>
                <a href="index.php?action=aniadirNivel&controller=niveles"><button id="aniadirnivel"><p>+</p></button></a>
           </div>
           <div>
    <?php
        foreach ($dataToView["data"] as $nivel) {
    ?>
                <div>
                    <p><?php echo $nivel['nombrepais']; ?></p>
                    <a href="index.php?controller=conflictos&action=listarConflictos&nivel_id=<?php echo $nivel['id']; ?>&nombrepais=<?php echo $nivel['nombrepais']; ?>"><p>></p></a>
                    <a href="index.php?controller=reflexiones&action=gestionarReflexiones&nivel_id=<?php echo $nivel['id'];?>&nombrepais=<?php echo $nivel['nombrepais'];?>"><img style='margin-left:15px;' src='../img/iconos/libro.png'></a>
                    <a href="index.php?action=modificarNivel&controller=niveles&id=<?php echo $nivel['id']; ?>&nombrepais=<?php echo $nivel['nombrepais']; ?>"><img style="margin-left:15px;" src="../img/iconos/edit.png"></a>
                    <a href="index.php?action=borrarNivel&controller=niveles&id=<?php echo $nivel['id']; ?>&nombrepais=<?php echo $nivel['nombrepais']; ?>"><img src="../img/iconos/basura.png"></a>
                </div>
    <?php
        }
    ?>
           </div>
        </div>

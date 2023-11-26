        <div id="panelCentro">
           <div>
                <p>NIVELES</p>
                <a href="index.php?action=aniadirNivel&controller=Niveles"><button id="aniadirnivel"><p>+</p></button></a>
           </div>
           <div>
    <?php 
        foreach ($dataToView["data"] as $nivel) {
    ?>
                <div>   
                    <p><?php echo $nivel['nombrepais']; ?></p>
                    <a href="index.php?controller=Conflictos&action=listarConflictos&nivel_id=<?php echo $nivel['id']; ?>&nombrepais=<?php echo $nivel['nombrepais']; ?>"><p>></p></a> 
                    <a href="index.php?action=modificarNivel&controller=Niveles&id=<?php echo $nivel['id']; ?>&nombrepais=<?php echo $nivel['nombrepais']; ?>"><img style="margin-left:15px;" src="../img/iconos/edit.png"></a>
                    <a href="index.php?action=borrarNivel&controller=Niveles&id=<?php echo $nivel['id']; ?>&nombrepais=<?php echo $nivel['nombrepais']; ?>"><img src="../img/iconos/basura.png"></a>
                </div>
    <?php
        }
    ?>
           </div>
        </div>
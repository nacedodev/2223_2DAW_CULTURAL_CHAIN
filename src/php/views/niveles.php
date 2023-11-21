<img id="logo" src="../img/iconos/logo.jpeg">
        <button class="boton">
            <img src="../img/iconos/sol.png">
        </button>
        <p class="tituloranking" style="margin-top:30px">NIVEL</p>
        <div id="panelCentro">
           <div>
                <p>NIVEL</p>
                <a href="index.php?action=aniadirNivel&controller=Niveles"><button id="aniadirnivel"><p>+</p></button></a>
           </div>
           <div>
    <?php 
        foreach ($dataToView["data"] as $nivel) {
    ?>
                <div>   
                    <p><?php echo $nivel['nombrepais']; ?></p>
                    <a href="index.php?controller=Niveles&action=listarNiveles&nivel_id=<?php echo $nivel['id']; ?>&nombrepais=<?php echo $nivel['nombrepais']; ?>"><p>></p></a> 
                    <a href="index.php?action=modificarNivel&controller=Niveles&id=<?php echo $nivel['id']; ?>&nombrepais=<?php echo $nivel['nombrepais']; ?>"><img style="margin-left:15px;" src="../img/iconos/edit.png"></a>
                    <a href="index.php?action=borrarNivel&controller=Niveles&id=<?php echo $nivel['id']; ?>&nombrepais=<?php echo $nivel['nombrepais']; ?>"><img src="../img/iconos/basura.png"></a>
                </div>
    <?php
        }
    ?>
           </div>
        </div>
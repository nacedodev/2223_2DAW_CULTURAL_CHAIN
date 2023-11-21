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
                    <p></p>
                    <!--<a href="index.php?controller=Clases&action=listarClases&centro_id=<?php /*echo $centro['id']; ?>&centronombre=<?php echo $centro['nombre']; ?>"><p>></p></a>
                    <a href="index.php?action=modificarCentro&controller=Centros&id=<?php echo $centro['id']; ?>&nombre=<?php echo $centro['nombre']; ?>&localidad=<?php echo $centro['localidad']; */?>"><img style="margin-left:15px;" src="../img/iconos/edit.png"></a>


                    <a href="index.php?action=borrarCentro&controller=Centros&id=<?php/* echo $centro['id']; ?>&nombre=<?php echo $centro['nombre']; */?>"><img src="../img/iconos/basura.png"></a>-->
                </div>
    <?php
        }
    ?>
           </div>
        </div>
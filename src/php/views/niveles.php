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
                    <p><?php echo $nivel['id']; ?></p>    
                    <p><?php echo $nivel['nombrepais']; ?></p>
                </div>
    <?php
        }
    ?>
           </div>
        </div>
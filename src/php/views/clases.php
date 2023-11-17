<p class="tituloranking">Clase</p>
<div id="panelCentro">
    <div>
        <p>Clases</p>
        <a href="admin.php?action=aniadirClases&controller=Clases&centro_id=<?php echo $_GET['centro_id']; ?>"><button id="aniadirclase"><p>+</p></button></a>
    </div>
    <div>
        <?php 
            foreach ($dataToView["data"] as $clase) {
        ?>
            <div>
                <p><?php echo $clase['etapa']; ?></p>
                <p><?php echo $clase['clase']; ?></p>
               
                <a href="admin.php?action=modificarClases&controller=Clases&centro_id=<?php echo $_GET['centro_id']; ?>&id=<?php echo $clase['id']; ?>&etapa=<?php echo $clase['etapa']; ?>&clase=<?php echo $clase['clase']; ?>"><p>M</p></a>

                <a href="admin.php?action=borrarClases&controller=Clases&id=<?php echo $clase['id']; ?>&centro_id=<?php echo $_GET['centro_id']; ?>"><img src="img/iconos/basura.png"></a>
            </div>
        <?php
            }
        ?>
    </div>
</div>
<p id="botonatras"><a href="admin.php">ATRAS</a></p>

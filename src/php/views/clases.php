<div id="panelCentro">
    <div>
        <p> <?php echo $_GET['centronombre']; ?> </p>
        <a href="index.php?action=aniadirClases&controller=clases&centro_id=<?php echo $_GET['centro_id']; ?>&centronombre=<?php echo $_GET['centronombre']; ?>"><button id="aniadirclase"><p>+</p></button></a>
    </div>
    <div>
        <?php 
            foreach ($dataToView["data"] as $clase) {
        ?>
            <div>
                <p><?php echo $clase['etapa']; ?></p>
                <p><?php echo $clase['clase']; ?></p>
               
                <a href="index.php?action=modificarClases&controller=clases&centro_id=<?php echo $_GET['centro_id']; ?>&id=<?php echo $clase['id']; ?>&etapa=<?php echo $clase['etapa']; ?>&clase=<?php echo $clase['clase']; ?>&centronombre=<?php echo $_GET['centronombre']; ?>"><img style="margin-left:15px;" src="../img/iconos/edit.png"></a>

                <a href="index.php?action=borrarClases&controller=clases&id=<?php echo $clase['id']; ?>&centro_id=<?php echo $_GET['centro_id']; ?>&clase=<?php echo $clase['clase']; ?>&centronombre=<?php echo $_GET['centronombre']; ?>"><img src="../img/iconos/basura.png"></a>
            </div>
        <?php
            }
        ?>
    </div>
</div>
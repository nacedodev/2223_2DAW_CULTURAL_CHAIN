<div id='panelCentro'>
    <div>
        <p>SELECCIONAR NIVEL</p>
    </div>
    <div>
        <?php
        foreach ($dataToView['data'] as $nivel) {
            ?>
            <div>
                <p><?php echo $nivel['nombrepais']; ?></p>
                <a href="index.php?controller=reflexiones&action=gestionarReflexiones&nivel_id=<?php echo $nivel['id'];?>&nombrepais=<?php echo $nivel['nombrepais'];?>">
                    <p>></p></a>
            </div>
            <?php
        }
        ?>
    </div>
</div>

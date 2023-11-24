<p class="tituloranking" style="margin-top:30px">Conflicto</p>
<div id="panelCentro">
    <div>
        <p> <?php echo $_GET['nombrepais']; ?> </p>
        <a href="index.php?action=aniadirConflictos&controller=Conflictos&nivel_id=<?php echo $_GET['nivel_id']; ?>&nombrepais=<?php echo $_GET['nombrepais']; ?>"><button id="aniadirclase"><p>+</p></button></a>
    </div>
    <div>
        <?php 
            foreach ($dataToView["data"] as $conflicto) {
        ?>
            <div>
                <p><?php echo $conflicto['id']; ?></p>
                <p><?php echo $conflicto['nombreconflicto']; ?></p>
                <p><?php echo $conflicto['estadoconflicto']; ?></p>
                <a href="index.php?action=borrarConflictos&controller=Conflictos&id=<?php echo $conflicto['id'];?>&nivel_id=<?php echo $_GET['nivel_id'];?>&nombreconflicto=<?php echo $conflicto['nombreconflicto'];?>&nombrepais=<?php echo $_GET['nombrepais']; ?>"><img src="../img/iconos/basura.png"></a>
            </div>
        <?php
            }
        ?>
    </div>
</div>
<p id="botonatras"><a href="index.php?controller=Niveles&action=listarNiveles">ATRAS</a></p>
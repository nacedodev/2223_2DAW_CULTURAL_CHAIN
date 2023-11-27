<div id="vistaForm">
    <p>Quieres Borrar el conflicto <?php echo $_GET['nombreconflicto']; ?> del nivel <?php echo $_GET['nombrepais']; ?></p>
    <form id="form-end" action="index.php?action=borrarConflictos&controller=conflictos&id=<?php echo $_GET['id']; ?>&nivel_id=<?php echo $_GET['nivel_id']; ?>&nombrepais=<?php echo $_GET['nombrepais']; ?>" method="post">
        <input type="submit" value="Sí">
        <input  type="submit" value="No">
    </form>
</div>
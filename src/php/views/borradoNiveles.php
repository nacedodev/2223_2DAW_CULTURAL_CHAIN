<div id="vistaForm">
    <p>Quieres Borrar el nivel <?php echo $_GET['nombrepais']; ?></p>
    <form id="form-end" action="index.php?action=borrarNivel&controller=Niveles&id=<?php echo $_GET['id']; ?>" method="post">
        <input type="submit" value="Sí">
    </form>

    <form action="index.php" method="post">
        <input  type="submit" value="No">
    </form>
</div>
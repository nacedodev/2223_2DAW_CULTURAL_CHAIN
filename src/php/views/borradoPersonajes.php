<div id="vistaForm">
    <p>Quieres Borrar el nivel <?php echo $_GET['nombrepais']; ?></p>
    <form id="form-end" action="index.php?action=borrarPersonaje&controller=personajes&id=<?php echo $_GET['id']; ?>" method="post">
        <input type="submit" value="Sí">
        <input  type="submit" value="No">
    </form>
</div>
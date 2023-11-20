<div id="vistaForm">
    <p>Quieres Borrar la clase <?php echo $_GET['clase']; ?> del centro <?php echo $_GET['centronombre']; ?></p>
    <form id="form-end" action="index.php?action=borrarClases&controller=Clases&id=<?php echo $_GET['id']; ?>&centro_id=<?php echo $_GET['centro_id']; ?>&centronombre= <?php echo $_GET['centronombre']; ?>" method="post">
        <input type="submit" value="Sí">
    </form>

    <form action="index.php?controller=Clases&action=listarClases&centro_id=<?php echo $_GET['centro_id']; ?>&centronombre=<?php echo $_GET['centronombre']; ?>" method="post">
        <input  type="submit" value="No">
    </form>
</div>
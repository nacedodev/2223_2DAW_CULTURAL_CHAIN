<p>Quieres Borrar el centro <?php echo $_GET['nombre']; ?></p>
<form id="form-end" action="index.php?action=borrarCentro&controller=Centros&id=<?php echo $_GET['id']; ?>" method="post">
    <input type="submit" value="Sí">
</form>

<form action="index.php" method="post">
    <input  type="submit" value="No">
</form>
<div id="vistaForm">
    <form id="formularioCentro" name="formularioCentro" action="index.php?action=aniadirClases&controller=Clases&centro_id=<?php echo $_GET['centro_id']; ?>" method="post">


    <label for="etapa">etapa</label>
    <input type="text" id="etapa" name="etapa" required>

    <label for="clase">clase:</label>
    <input type="text" id="clase" name="clase" required>

        <input type="submit">
    </form>
</div>

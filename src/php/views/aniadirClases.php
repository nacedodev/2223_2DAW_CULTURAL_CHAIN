<div id="vistaForm">
    <form id="form-end" name="formularioCentro" action="index.php?action=aniadirClases&controller=clases&centro_id=<?php echo $_GET['centro_id']; ?>&centronombre=<?php echo $_GET['centronombre']; ?>" method="post">


    <label for="etapa">etapa</label>
    <input type="text" id="etapa" name="etapa" >
    <span id="etapa-error" class="error-message"></span><br><br>

    <label for="clase">clase:</label>
    <input type="text" id="clase" name="clase" >
    <span id="clase-error" class="error-message"></span><br><br>

        <button id="send" type="submit">Enviar</button>
        <span id="status-message" style="margin-left: 100px;"></span>
    </form>
</div>
<script type="module" src="../js/views/vistaFormClases.js"></script>
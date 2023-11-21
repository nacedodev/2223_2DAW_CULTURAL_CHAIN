<div id="vistaForm">
    <form id="form-end" name="formularioCentro" action="index.php?action=aniadirNivel&controller=Niveles" method="post">

    <label for="nombre">Nombre del País:</label>
    <input type="text" id="nombre" name="nombrepais" >
    <span id="centro-error" class="error-message"></span><br><br>

    <span id="localidad-error" class="error-message"></span><br><br>
        <button id="send" type="submit">Enviar</button>
        <span id="status-message" style="margin-left: 100px;"></span>
    </form>
</div>
<!--<script type="module" src="../js/views/vistaFormCentros.js"></script>-->
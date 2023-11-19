<div id="vistaForm">
    <form id="form-end" name="formularioCentro" action="index.php?action=aniadirCentro&controller=Centros" method="post">

    <label for="nombre">Nombre del Centro:</label>
    <input type="text" id="nombre" name="nombre" >
    <span id="centro-error" class="error-message"></span><br><br>

    <label for="localidad">Localidad:</label>
    <input type="text" id="localidad" name="localidad" required>
    <span id="localidad-error" class="error-message"></span><br><br>

        <button id="send" type="submit">Enviar</button>
        <span id="status-message" style="margin-left: 100px;"></span>
    </form>
</div>
<script type="module" src="../js/views/vistaFormCentros.js"></script>
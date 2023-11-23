<div id="vistaForm">
    <form id="form-end" enctype="multipart/form-data" name="formularioCentro" action="index.php?action=aniadirNivel&controller=Niveles" method="post">

    <label for="nombrepais">Nombre del País:</label>
    <input type="text" id="nombrepais" name="nombrepais" >
    <span id="centro-error" class="error-message"></span><br><br>
    
    <label for="imagen">Imagen de fondo:</label>
    <input type="file" id="imagen" name="imagen">

    <span id="localidad-error" class="error-message"></span><br><br>
        <button id="send" type="submit">Enviar</button>
        <span id="status-message" style="margin-left: 100px;"></span>
    </form>
</div>
<script type="module" src="../js/views/vistaFormNiveles.js"></script>
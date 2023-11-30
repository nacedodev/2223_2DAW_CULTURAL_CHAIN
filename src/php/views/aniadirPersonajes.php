<div id="vistaForm">
    <form id="form-end" enctype="multipart/form-data" name="formularioCentro" action="index.php?action=aniadirPersonajes&controller=personajes" method="post">
    <label for="nombre">Nombre del personaje:</label>
    <input type="text" id="nombre" name="nombre" >
    <span id="centro-error" class="error-message"></span><br><br>

    <label for="pais">País:</label>
    <input type="text" id="pais" name="pais" >
    <span id="centro-error" class="error-message"></span><br><br>

    <label for="imagenPersonaje">Apariencia:</label>
    <input type="file" id="imagenPersonaje" name="imagenPersonaje">
    <span id="localidad-error" class="error-message"></span><br><br>

        <button id="send" type="submit">Enviar</button>
        <span id="status-message" style="margin-left: 100px;"></span>
    </form>
</div>
<script type="module" src=""></script>
<div id="vistaForm">
    <form id="form-end" enctype="multipart/form-data" name="formularioCentro" action="index.php?action=aniadirConflictos&controller=Conflictos&nivel_id=<?php echo $_GET['nivel_id'];?>&nombrepais=<?php echo $_GET['nombrepais'];?>" method="post">

        <label for="nombreConficto">Nombre del conflicto:</label>
        <input type="text" id="nombreConflicto" name="nombreConficto">
        <span id="nombreConflicto-error" class="error-message"></span><br><br>

        <label for="estadoconflicto">Estado:</label>
        <input type="text" id="estadoconflicto" name="estadoconflicto">

        <label for="ejeX">Eje X:</label>
        <input type="text" id="ejeX" name="ejeX">
        <span id="ejeX-error" class="error-message"></span><br><br>

        <label for="ejeY">Eje Y:</label>
        <input type="text" id="ejeY" name="ejeY">
        <span id="ejeY-error" class="error-message"></span><br><br>

        <button id="send" type="submit">Enviar</button>
        <span id="status-message" style="margin-left: 100px;"></span>
    </form>

    <div id="whiteDiv" style="width: 600px; height: 600px; background-color: white; margin-left: 10%; border-radius:5px"></div>
</div>


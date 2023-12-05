<div id="vistaForm">
    <form id="form-end" enctype="multipart/form-data" name="formularioCentro" action="index.php?action=modificarConflictos&controller=conflictos&nivel_id=<?php echo $_GET['nivel_id'];?>&nombrepais=<?php echo $_GET['nombrepais'];?>" method="post" style="position:static; transform: translate(0)">

        <label for="nombreConficto">Nombre del conflicto:</label>
        <input type="text" id="nombreConflicto" name="nombreconflicto" value="<?php echo isset($_GET['nombreconflicto']) ? $_GET['nombreconflicto'] : ''; ?>">
        <span id="nombreConflicto-error" class="error-message"></span><br><br>

        <label for="estadoconflicto">Estado:</label>
        <input type="text" id="estadoconflicto" name="estadoconflicto" value="<?php echo isset($_GET['estadoconflicto']) ? $_GET['estadoconflicto'] : ''; ?>">
        <span id="estadoConflicto-error" class="error-message"></span><br><br> <!-- Corregido el ID -->

        <label for="ejeX">Eje X:</label>
        <input type="text" id="ejeX" name="ejeX" value="<?php echo isset($_GET['posx']) ? $_GET['posx'] : ''; ?>">
        <span id="ejeX-error" class="error-message"></span><br><br>

        <label for="ejeY">Eje Y:</label>
        <input type="text" id="ejeY" name="ejeY" value="<?php echo isset($_GET['posy']) ? $_GET['posy'] : ''; ?>">
        <span id="ejeY-error" class="error-message"></span><br><br>

        <button id="send" type="submit">Enviar</button>
        <span id="status-message" style="margin-left: 100px;"></span>
        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
    </form>

    <div id="whiteDiv" style="width: 50vh; height: 50vh; background-color: white; margin-left: 10%; border-radius:5px">
        <div id="divrojo" style="background-color:red;width: 25px;height:25px; position:relative;left:<?php echo isset($_GET['posx']) ? $_GET['posx'] : ''; ?>%;top:<?php echo isset($_GET['posy']) ? $_GET['posy'] : ''; ?>%;"></div>
    </div>
</div>
<script type="module" src="../js/views/vistaFormConflictosEdit.js"></script>


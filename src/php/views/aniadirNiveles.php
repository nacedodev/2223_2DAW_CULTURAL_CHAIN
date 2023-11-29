</head>
<body>
       
<div id="vistaForm" style="overflow:auto; flex-direction: column">
    <form id="form-end" name="formularioCentro" action="index.php?action=aniadirCentro&controller=centros" method="post" style="position:static ;transform:none ;margin-top:5%">

        <label for="titulo">Título:</label>
        <input style="height: 80px" type="text" id="titulo" name="titulo">
        <span id="titulo-error" class="error-message"></span><br><br>

        <label for="descripcion">Reflexión:</label>
        <input type="text" id="descripcion" name="descripcion">
        <span id="descripcion-error" class="error-message"></span><br><br>

        <button id="send" type="submit">Enviar</button>
        <span id="status-message" style="margin-left: 100px;"></span>
        <button class="boton borrar" style="float: right; position:relative; bottom:100px; left:27%"><img alt="-"></button>
    </form>
</div>

<button id="aniadir" class="boton" style=" height: 65px; margin-top: 20px;margin-bottom:5%;position:relative; top:50px;left:48%"><img src="" alt="+"></button>
<script type="module" src="../js/views/vistaformreflexiones.js"></script>
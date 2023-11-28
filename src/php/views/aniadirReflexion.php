</head>
<body>
        <button class="boton" style="margin-left:35%;  width:30%; height: 65px " onclick="agregarFormulario()"><img src="../img/iconos/anadir.png" alt="+"></button>
       
<div id="vistaForm">
    <form id="form-end" name="formularioCentro" action="index.php?action=aniadirCentro&controller=centros" method="post">

        <label for="titulo">Título:</label>
        <input style="height: 80px" type="text" id="titulo" name="titulo">
        <span id="titulo-error" class="error-message"></span><br><br>

        <label for="descripcion">Reflexión:</label>
        <input type="text" id="descripcion" name="descripcion">
        <span id="descripcion-error" class="error-message"></span><br><br>

        <button id="send" type="submit">Enviar</button>
        <span id="status-message" style="margin-left: 100px;"></span>
        <button class="boton" style="float: right"><img src="../img/iconos/x.png" alt="-"></button>
    </form>
</div>



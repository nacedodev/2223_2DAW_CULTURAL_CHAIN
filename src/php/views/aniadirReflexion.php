</head>
<body>
        <button class="boton" style="margin-left:44%" onclick="agregarFormulario()"><img src="../img/iconos/anadir.png" alt="+"></button>
        <button class="boton" style="margin-left:5%"><img src="../img/iconos/x.png" alt="-"></button>
<div id="vistaForm">
    <form id="form-end" name="formularioCentro" action="index.php?action=aniadirCentro&controller=centros" method="post">

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo">
        <span id="titulo-error" class="error-message"></span><br><br>

        <label for="descripcion">Reflexion:</label>
        <input type="text" id="descripcion" name="descripcion">
        <span id="descripcion-error" class="error-message"></span><br><br>

        <button id="send" type="submit">Enviar</button>
        <span id="status-message" style="margin-left: 100px;"></span>
        <br><br>
        
    </form>
</div>



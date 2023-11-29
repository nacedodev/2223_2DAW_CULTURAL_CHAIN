</head>
<body>
       
<div id="vistaForm" style=" flex-direction: column;">
    <form id="form-end" name="formularioCentro" action="index.php?action=aniadirCentro&controller=centros" method="post" style="width:95% ;position:static ;transform:none ;margin-top:15px; display:flex; align-content: center;align-items: center;">

        <label for="titulo">Título:</label>
        <input style="height: 80px; width:33%; display:inline-block;" type="text" id="titulo" name="titulo">
        <span id="titulo-error" class="error-message"></span>

        <label for="descripcion">Reflexión:</label>
        <input style="width: 45%; display:inline-block; height: 80px" type="text" id="descripcion" name="descripcion">
        <span id="descripcion-error" class="error-message"></span>
       
       
        <span id="status-message" style="margin-left: 100px;"></span>
        <button class="boton" style="float: right; margin-top: 1%;"><img src="../img/iconos/x.png" alt="-"></button>
    </form>
</div>

<button class="boton" style=" height: 65px; margin-top: 20px;margin-bottom:5%;position:relative; top:50px;left:48%"><img src="../img/iconos/anadir.png" alt="+"></button>
<div style="position: fixed; bottom: 0; left: 0; width: 100%; padding: 10px; text-align: center;">
    <button id="send"  type="submit" style=" z-index: 1;width:20%; background-color:#6F7789 ; padding: 10px; box-sizing: border-box; border: none; border-radius: 5px; cursor: pointer;">Enviar</button>
</div>


       



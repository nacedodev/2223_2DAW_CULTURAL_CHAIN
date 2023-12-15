<div id='vistaFormReflexiones' style='flex-direction: column;'>
    <p style="margin:0;color: var(--terciary);font-size: 2vw;font-family: 'Poppins', sans-serif"> <?php echo $_GET['nombrepais']; ?> </p>
    <?php if(isset($controlador->mensaje)): ?> <!-- Si nos llega algún tipo de mensaje desde el controlador , lo mostramos-->
        <p id="error-edit"><?php echo $controlador->mensaje; ?></p>
    <?php endif; ?>
    <div id="cabecera">
        <p>Título</p>
        <p>Reflexión</p>
    </div>
    <form id='form-reflexion' name='formularioCentro'
          action='index.php?action=gestionarReflexiones&controller=reflexiones&nivel_id=<?php echo $_GET['nivel_id']; ?>&nombrepais=<?php echo $_GET['nombrepais'];?>'
          method='post'
          style='width:100%; position:static; transform:none;background-color: transparent;'>
        <div id='reflections-container'>
            <!-- Espacio para múltiples reflexiones -->
            <?php foreach ($dataToView['data'] as $reflexion) : ?>
                <div class='reflection'>
                    <input id="title" style='height: 50px; width:30%; display:inline-block;font-size:1.1vw;font-family: "Poppins", sans-serif' type='text' name='titulos[]'
                           value='<?php echo $reflexion['titulo']; ?>'>
                    <input id="content" style='width: 60%; display:inline-block; height: 50px;margin-left:65px;font-family: "Poppins", sans-serif' type='text' name='contenidos[]'
                           value='<?php echo $reflexion['contenido']; ?>'>
                    <button class='remove-reflection' type='button'>-</button>
                </div>
            <?php endforeach; ?>
        </div>

        <button style='display: block;margin: 20px auto;' id='addButton' type='button'><img src="../img/iconos/aniadir.png" alt=""></button>

        <button id='send' type='submit'>ENVIAR</button>
    </form>
</div>
<script type="module" src="../js/views/vistareflexiones.js"></script>

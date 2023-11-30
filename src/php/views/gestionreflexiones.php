<div id='vistaForm' style='flex-direction: column;'>
    <p style="margin:0;color: var(--terciary);font-size: 2vw;font-family: 'Poppins', sans-serif"> <?php echo $_GET['nombrepais']; ?> </p>
    <form id='form-reflexion' name='formularioCentro'
          action='index.php?action=gestionarReflexiones&controller=reflexiones&nivel_id=<?php echo $_GET['nivel_id']; ?>'
          method='post'
          style='width:100%; position:static; transform:none; margin-top:15px;background-color: transparent;'>
        <div id='reflections-container'>
            <!-- Espacio para múltiples reflexiones -->
            <?php
            // Aquí mostramos las reflexiones existentes
            foreach ($dataToView['data'] as $reflexion) :
                ?>
                <div class='reflection'>
                    <label for='titulo'>Título:</label>
                    <input style='height: 50px; width:33%; display:inline-block;' type='text' name='titulos[]'
                           value='<?php echo $reflexion['titulo']; ?>'>
                    <label for='descripcion'>Reflexión:</label>
                    <input style='width: 52%; display:inline-block; height: 50px' type='text' name='contenidos[]'
                           value='<?php echo $reflexion['contenido']; ?>'>
                    <button style="margin-left: 20px" class='remove-reflection' type='button'>-</button>
                </div>
            <?php endforeach; ?>
        </div>

        <button style='display: block;margin: 20px auto' id='add-reflection' type='button'>+</button>

        <button id='send' type='submit'>ENVIAR</button>
    </form>
</div>

<script>
  document.getElementById('add-reflection').addEventListener('click', function () {
    const reflectionsContainer = document.getElementById('reflections-container');
    const reflectionTemplate = document.createElement('div');
    reflectionTemplate.classList.add('reflection');

    reflectionTemplate.innerHTML = `
                <label for='titulo'>Título:</label>
                <input style='height: 50px; width:33%; display:inline-block;' type='text' name='titulos[]'>
                <label for='descripcion'>Reflexión:</label>
                <input style='width: 52%; display:inline-block; height: 50px' type='text' name='contenidos[]'>
                <button style='margin-left: 20px' class='remove-reflection' type='button'>-</button>
        `;

    reflectionsContainer.appendChild(reflectionTemplate);
  });

  document.getElementById('reflections-container').addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-reflection')) {
      event.target.parentElement.remove();
    }
  });
</script>

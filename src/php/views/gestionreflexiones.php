<style>
  .reflection {

    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .remove-reflection {
    margin-left: 30px;
  }
</style>

<div id='vistaFormReflexiones' style='flex-direction: column;'>
    <p style="margin:0;color: var(--terciary);font-size: 2vw;font-family: 'Poppins', sans-serif"> <?php echo $_GET['nombrepais']; ?> </p>
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
                    <input style='height: 50px; width:30%; display:inline-block;font-size:1.1vw;font-family: "Poppins", sans-serif' type='text' name='titulos[]'
                           value='<?php echo $reflexion['titulo']; ?>'>
                    <input style='width: 60%; display:inline-block; height: 50px;margin-left:65px;font-family: "Poppins", sans-serif' type='text' name='contenidos[]'
                           value='<?php echo $reflexion['contenido']; ?>'>
                    <button class='remove-reflection' type='button'>-</button>
                </div>
            <?php endforeach; ?>
        </div>

        <button style='display: block;margin: 20px auto;' id='add-reflection' type='button'>+</button>

        <button style="position:relative;bottom: 59px;left:20px;" id='send' type='submit'>ENVIAR</button>
    </form>
</div>

<script>
  document.getElementById('add-reflection').addEventListener('click', function () {
    const reflectionsContainer = document.getElementById('reflections-container');
    const reflectionTemplate = document.createElement('div');
    reflectionTemplate.classList.add('reflection');

    reflectionTemplate.innerHTML = `
    <input style='height: 50px; width:30%; display:inline-block;font-size:1vw; font-family: "Poppins", sans-serif' type='text' name='titulos[]' placeholder='Título'>
    <input style='width: 60%; display:inline-block; height: 50px;margin-left:65px; font-family: "Poppins", sans-serif' type='text' name='contenidos[]' placeholder='Reflexión'>
    <button class='remove-reflection' type='button'>-</button>
`;

    reflectionsContainer.appendChild(reflectionTemplate);

    reflectionTemplate.scrollIntoView({ behavior: "smooth" });
  });

  document.getElementById('reflections-container').addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-reflection')) {
      event.target.parentElement.style.animation = 'slideOut 0.3s forwards'
      setTimeout(() => {
        event.target.parentElement.remove();
      }, 250)
    }
  });
</script>

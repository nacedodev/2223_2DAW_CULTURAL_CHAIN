<style>
  .reflection {

    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .remove-reflection {
    margin-left: 30px;
  }
  #send{
    position: relative;
    bottom:84px;
    left:0;
    background-color: var(--secondary) !important;
    color: var(--terciary) !important;
    padding: 3% 6%;
    border-radius: 10px;
    margin-top: 25px;
    font-size: 1vw;
    font-family: 'Poppins',sans-serif;
  }

  #send:hover{
    background-color: var(--terciary) !important;
  filter: drop-shadow(0 0 5px var(--terciary)) !important;
  color: var(--secondary) !important;
  }

  #addButton{
  display: flex !important;
  align-items: center;
  justify-content: center;
  width: 2.5vw;
  background-color: var(--terciary);
  padding:0 !important;
  border-radius: 10px;
  aspect-ratio: 1/1;
}

#addButton img{
  aspect-ratio: 1/1;
  width:70%;
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

<script>
  document.getElementById('addButton').addEventListener('click', function () {
    const reflectionsContainer = document.getElementById('reflections-container');
    const reflectionTemplate = document.createElement('div');
    reflectionTemplate.classList.add('reflection');

    const lastReflection = reflectionsContainer.lastElementChild; // Obtener el último figure // Obtener el anterior al último figure

  const tituloInput = lastReflection.querySelector('#title');
  const reflexionInput = lastReflection.querySelector('#content');

  console.log(tituloInput,reflexionInput)

  if (tituloInput != null) {
    const tituloValue = tituloInput.value;
    const reflexionValue = reflexionInput.value;

    // Verificar si el último div no está vacío (tanto el titulo como el contenido)
    if ((!tituloValue || tituloValue === '') && (!reflexionValue || reflexionValue === '')) {
      const addImg = document.querySelector('#addButton > img')
      addImg.style.animation = 'shakeAnimation 0.3s ease-in-out'
      setTimeout(() => {
        addImg.style.animation = 'none'
      }, 300)
      lastReflection.style.animation = 'warningAnimationRef 0.8s linear'
      setTimeout(() => {
        lastReflection.style.animation = 'none'
      }, 800)
      return
    }
  }

    reflectionTemplate.innerHTML = `
    <input id="title" style='height: 50px; width:30%; display:inline-block;font-size:1vw; font-family: "Poppins", sans-serif' type='text' name='titulos[]' placeholder='Título'>
    <input id="content" style='width: 60%; display:inline-block; height: 50px;margin-left:65px; font-family: "Poppins", sans-serif' type='text' name='contenidos[]' placeholder='Reflexión'>
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

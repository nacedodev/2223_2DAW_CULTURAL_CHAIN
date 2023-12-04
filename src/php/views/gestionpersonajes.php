<style>
/* Estilos para el contenedor */
div {
  width: 100%;
  margin: 30px auto;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start; /* Alineación a la izquierda */
}

input:-webkit-autofill {
    -webkit-text-fill-color: var(--secondary) !important;
}

/* Estilos para cada figura */
figure {
    position: relative;
    display: flex;
   flex-direction: column;
   align-items: center;
   justify-content: center;
   text-align: center;
    border-radius: 7px;
    border: 1px solid var(--terciary);
    background: var(--secondary);
    box-shadow: 4px 4px 4px 0px rgba(0, 0, 0, 0.25);
    width: 17.778%;
    margin: 10px 20px;
    aspect-ratio: 1/1.3;
}

figure > img {
    pointer-events: none;
    aspect-ratio: 37/60;
    width: 40%;
    margin: auto;
    display: block;
    border: 1px dashed rgba(46, 46, 75, 0.84);
    padding: 15px 40px;
    border-radius: 10px;
}

#dropzone{
    border:1px dashed var(--terciary);
    width: 40%;
    aspect-ratio: 37/60;
    padding: 15px 40px;
    border-radius: 10px;
    margin: auto;
    display: block;
    filter: drop-shadow(0 0 6px var(--terciary))
}

#dropzone p{
  width: 95%;
  color: var(--terciary);
  font-size: 0.6vw;
  text-align: center;
  position: absolute;
  top:45%;
  left: 50%;
  transform: translate(-50%,-50%);
}
 
input[type='text'] {
  background-color: transparent; /* O puedes usar 'initial' */
  text-align: center;
  color: var(--terciary);
  border-radius: 10px;
  width: 40%;
  padding: 3px 10px;
  margin-bottom: 20px;
  border: 1px dashed rgba(46, 46, 75, 0.84);
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  /* Otros estilos para el texto del nombre del personaje */
}


figcaption {
    color: var(--terciary);
    border-radius: 10px;
    min-width: 40%;
    padding: 3px 10px;
  margin-bottom: 20px;
  border: 1px dashed var(--terciary);
  /* Otros estilos para el texto del nombre del personaje */
}

#add-btn{
    background-color: transparent;
    border: none;
    box-shadow: none;
}

#addButton{
    background-color: var(--terciary);
    padding:4%;
    border-radius: 10px;
    aspect-ratio: 1/1;
}

#sendButton{
  background-color: var(--secondary);
  color: var(--terciary);
  padding: 3% 6%;
  border-radius: 10px;
  margin-top: 25px;
  font-size: 1.1vw;
}

#sendButton:hover{
  background-color: var(--terciary);
  filter: drop-shadow(0 0 5px var(--terciary));
  color: var(--secondary);
}

/* Estilos para el botón '+' */

/* Mostrar el botón solo cuando se coloque el cursor sobre el figure */
figure:hover .add-button {
  display: block;
}

.remove-button {
    position: absolute;
    top: 10px; /* Ajusta la distancia desde la parte superior */
    right: 10px; /* Ajusta la distancia desde la parte derecha */
    background-color: var(--terciary);
    padding:2%;
    width: 8%;
    border-radius: 5px;
    aspect-ratio: 1/1;
    font-size: 0.4vw;
    cursor: pointer;
  }

  .edit-button{
    position: absolute;
    top: 10px; /* Ajusta la distancia desde la parte superior */
    left: 10px; /* Ajusta la distancia desde la parte derecha */
    background-color: var(--terciary);
    padding:2%;
    width: 8%;
    border-radius: 5px;
    aspect-ratio: 1/1;
    font-size: 0.4vw;
    cursor: pointer; 
  }

  .file-input {
    position: absolute;
    opacity: 0;
    width: 80%; /* Ancho del input, ajusta según tu diseño */
    height: 65%; /* Alto del input, ajusta según tu diseño */
    top: 44%;
    left: 50%;
    transform: translate(-50%, -50%);
    cursor: pointer;
  }
  #error-edit{
  text-align: center;
  color: var(--terciary);
  font-size: 1vw;
  margin-top:40px;
  filter: drop-shadow(0 0 3px black);
}
</style>
<?php if(isset($_GET['mensaje'])): ?>
        <p id="error-edit"><?php echo $_GET['mensaje']; ?></p>
    <?php endif; ?>
<form enctype="multipart/form-data" style="background: transparent;" action="index.php?action=gestionarPersonajes&controller=personajes" method="post">
<div id="figures-container">
          <?php foreach ($dataToView['data'] as $personaje) : ?>
              <figure class="figure-container" data-image="">
                  <img src="data:image/png;base64,<?php $imagen = new Personaje(HOST,USER,PASSWORD,DATABASE, CHARSET); echo $imagen->obtenerImagenPorId($personaje['id']);?>" class="personaje" name="imagenPersonajes[]">
                  <input type="hidden" name="imagenExistentes[]" value="<?php echo $imagen->obtenerImagenPorId($personaje['id']); ?>">
                  <input type="text" value="<?php echo $personaje['nombre']; ?>" class="personaje-input" readonly>
                  <button class="remove-button" type="button" onclick="window.location.href = 'index.php?controller=personajes&action=borrarPersonaje&id=<?php echo $personaje['id']?>&nombre=<?php echo $personaje['nombre']?>'">-</button>
                  <button class="edit-button" type="button" onclick="window.location.href = 'index.php?controller=personajes&action=modificarPersonajes&id=<?php echo $personaje['id']?>&nombre=<?php echo $personaje['nombre'] ?>'"><img width="85%"src="../img/iconos/edit.png" style="pointer-events:none" alt="/"></button>
              </figure>
          <?php endforeach; ?>
        <figure id="add-btn">
            <button id="addButton"type='button'>+</button>
            <button id="sendButton" type="submit">Enviar</button>
        </figure>
  </div>
</form>
<script>
  const fileInputs = document.querySelectorAll('.file-input');
  const imageContainers = document.querySelectorAll('.figure-container');


  fileInputs.forEach((input, index) => {
    input.addEventListener('change', function(e) {
      const file = e.target.files[0];
      const imageContainer = imageContainers[index];

      if (file) {
        const reader = new FileReader();

        reader.onload = function(event) {
          const imageURL = event.target.result;
          const img = imageContainer.querySelector('.personaje');
          
          img.src = imageURL;
          imageContainer.setAttribute('data-image', imageURL);
        }

        reader.readAsDataURL(file);
      }
    });
  });


  document.getElementById('addButton').addEventListener('click', function (event) {
  event.preventDefault(); // Evita que el formulario se envíe

  const figuresContainer = document.getElementById('figures-container');
  const figureTemplate = document.createElement('figure');
  figureTemplate.classList.add('figure-container');

  figureTemplate.innerHTML = `
    <div id="dropzone">
      <p>Arrastra o haz click</p>
    </div>
        <img  class="personaje" src="" class="personaje" style="display: none;">
    <input type="file" class="file-input" name="imagenPersonajes[]">
    <input id='newname' type="text" value="" class="personaje-input" name="nombres[]" style="border: 1px dashed var(--terciary); filter: drop-shadow(0 0 5px var(--terciary))">
    <button class="remove-button" type="button">-</button>
  `;

  // Encuentra el botón '+' en el contenedor y añade el nuevo figure justo antes de él
  const addButton = figuresContainer.querySelector('#add-btn');
  figuresContainer.insertBefore(figureTemplate, addButton);

  const newNameInputs = document.querySelectorAll('.personaje-input');

newNameInputs.forEach(newName => {
  newName.addEventListener('blur', function() {
    newName.style.border = '1px dashed #2e2e4b9c';
    newName.style.filter = 'none';
  });
});

  figureTemplate.scrollIntoView({ behavior: 'smooth' });

  const newFileInput = figureTemplate.querySelector('.file-input');
  const newImageContainer = figureTemplate;

  newFileInput.addEventListener('change', function (e) {
  const file = e.target.files[0];
  const dropdivs = document.querySelectorAll('#dropzone'); // Selecciona todos los dropzone
  
  if (file) {
    const reader = new FileReader();
    
    reader.onload = function (event) {
      const imageURL = event.target.result;
      const img = newImageContainer.querySelector('.personaje');
      
      if (!file.type.startsWith('image/')) {
        // Ruta de la imagen por defecto
        const defaultImageURL = '../img/iconos/doc.png';
        img.style.objectFit = 'contain';
        img.src = defaultImageURL;
        newImageContainer.setAttribute('data-image', defaultImageURL);
      } else {
        img.src = imageURL;
        newImageContainer.setAttribute('data-image', imageURL);
      }
      
      // Oculta todos los dropzone encontrados
      dropdivs.forEach(dropdiv => {
        dropdiv.style.display = 'none';
      });
      
      img.style.display = 'block';
      img.style.pointerEvents = 'none';
    };
    
    reader.readAsDataURL(file);
  }
});

});

document.getElementById('figures-container').addEventListener('click', function(event) {
  if (event.target.classList.contains('remove-button')) {
    const figureContainer = event.target.closest('figure');
    figureContainer.style.animation = 'slideOutAndRotate 0.3s forwards';
    setTimeout(() => {
      figureContainer.remove();
    }, 300);
  }
});

document.getElementById('figures-container').addEventListener('click', function(event) {
  if (event.target.classList.contains('edit-button')) {
   const figureContainer = event.target.closest('figure');
    figureContainer.style.animation = 'editAnimation 0.3s forwards';
  }
});
</script>

<style>
/* Estilos para el contenedor */
div {
  width: 100%;
  margin: 30px auto;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start; /* Alineación a la izquierda */
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

#add-btn button{
    background-color: var(--terciary);
    padding:4%;
    border-radius: 10px;
    aspect-ratio: 1/1;
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



</style>
<form style="background: transparent;">
<div id="figures-container">
                    
                    <figure class="figure-container" data-image="">
                        <img id="Baku" src="../img/personajes/person002.png" class="personaje">
                        <input type="file" class="file-input">
                        <input type="text" value="Baku" class="personaje-input">
                        <button class="remove-button" type="button">-</button>
                    </figure>
                    <figure class="figure-container" data-image="">
                        <img id="Pauline" src="../img/personajes/person003.png" class="personaje">
                        <input type="file" class="file-input">
                        <input type="text" value="Baku" class="personaje-input">
                        <button class="remove-button" type="button">-</button>
                    </figure>
                    <figure class="figure-container" data-image="">
                        <img id="Ayara" src="../img/personajes/person004.png" class="personaje">
                        <input type="file" class="file-input">
                        <input type="text" value="Baku" class="personaje-input">
                        <button class="remove-button" type="button">-</button>
                    </figure>
                    <figure class="figure-container" data-image="">
                        <img id="Logan" src="../img/personajes/person005.png" class="personaje">
                        <input type="file" class="file-input">
                        <input type="text" value="Baku" class="personaje-input">
                        <button class="remove-button" type="button">-</button>
                    </figure>
                    <figure class="figure-container" data-image="">
                        <img id="Manu" src="../img/personajes/person006.png" class="personaje">
                        <input type="file" class="file-input">
                        <input type="text" value="Baku" class="personaje-input">
                        <button class="remove-button" type="button">-</button>
                    </figure>
                    <figure class="figure-container" data-image="">
                        <img id="Eva" src="../img/personajes/person007.png" class="personaje">
                        <input type="file" class="file-input">
                        <input type="text" value="Baku" class="personaje-input">
                        <button class="remove-button" type="button">-</button>
                    </figure>
                    <figure class="figure-container" data-image="">
                        <img id="Nalani" src="../img/personajes/person008.png" class="personaje">
                        <input type="file" class="file-input">
                        <input type="text" value="Baku" class="personaje-input">
                        <button class="remove-button" type="button">-</button>
                    </figure>
                    <figure class="figure-container" data-image="">
                        <img id="Paul" src="../img/personajes/person009.png" class="personaje">
                        <input type="file" class="file-input">
                        <input type="text" value="Baku" class="personaje-input">
                        <button class="remove-button" type="button">-</button>
                    </figure>
                    <figure id="add-btn">
                        <button id="addButton"type='button'>+</button>
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
    <div id="dropzone"></div>
        <img  class="personaje" src="" class="personaje" style="display: none;">
    <input type="file" class="file-input">
    <input id='newname' type="text" value="" class="personaje-input" style="border: 1px dashed var(--terciary); filter: drop-shadow(0 0 5px var(--terciary))">
    <button class="remove-button" type="button">-</button>
  `;

  // Encuentra el botón '+' en el contenedor y añade el nuevo figure justo antes de él
  const addButton = figuresContainer.querySelector('#add-btn');
  figuresContainer.insertBefore(figureTemplate, addButton);

  const newName = document.getElementById('newname')
  newName.addEventListener('blur', function() {
  newName.style.border = '1px dashed #2e2e4b9c';
  newName.style.filter = 'none'
});

  figureTemplate.scrollIntoView({ behavior: 'smooth' });

  const newFileInput = figureTemplate.querySelector('.file-input');
  const newImageContainer = figureTemplate;

  newFileInput.addEventListener('change', function (e) {
    const file = e.target.files[0];
    const dropdiv =document.getElementById('dropzone')

    if (file) {
      const reader = new FileReader();

      reader.onload = function (event) {
        const imageURL = event.target.result;
        const img = newImageContainer.querySelector('.personaje');
        img.src = imageURL;
        dropdiv.style.display = 'none'
        img.style.display = 'block'
        newImageContainer.setAttribute('data-image', imageURL);
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

</script>
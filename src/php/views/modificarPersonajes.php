<style>

input:-webkit-autofill {
    -webkit-text-fill-color: var(--secondary) !important;
}

form{
    position:absolute;
    top:55%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 30%;
    max-width: 450px;
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
    width: 100%;
    max-width:670px;
    margin: 0 auto;
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

#send-figure{
    position: absolute;
    bottom: 10px; /* Ajusta la distancia desde la parte superior */
    right: 10px; /* Ajusta la distancia desde la parte derecha */
    background-color: var(--terciary);
    padding:1%;
    width: 8%;
    border-radius: 5px;
    aspect-ratio: 1/1;
    font-size: 0.6vw;
    cursor: pointer;
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
  filter: drop-shadow(0 0 3px black);
  margin-top: 70px;
}

</style>
    <?php if(isset($_GET['mensaje'])): ?>
        <p id="error-edit"><?php echo $_GET['mensaje']; ?></p>
    <?php endif; ?>
    <form style="background-color:transparent" enctype="multipart/form-data" name="formularioCentro" action="index.php?action=modificarPersonajes&controller=personajes" method="post">
    <figure class="figure-container" data-image="">
            <img src="data:image/png;base64,<?php $imagen = new Personaje(HOST,USER,PASSWORD,DATABASE, CHARSET); echo $imagen->obtenerImagenPorId($_GET['id']);?>" class="personaje">
            <input type="file" class="file-input" id="imagenPersonaje" name="imagenPersonaje">
            <input type="text" id="nombre" name="nombre" value="<?php echo isset($_GET['nombre']) ? $_GET['nombre'] : ''; ?>" required>
            <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            <button type="submit" id="send-figure"><img style="position:absolute;top:15%;left:18%;" width="70%" src="../img/iconos/send.png" alt=""></button>
    </figure>
    </form>
    <script>
     const fileInputs = document.querySelectorAll('.file-input');
      const imageContainers = document.querySelectorAll('.figure-container');

fileInputs.forEach((input, index) => {
  input.addEventListener('change', function(e) {
    const file = e.target.files[0];
    const imageContainer = imageContainers[index];
    const img = imageContainer.querySelector('.personaje');
    
    if (file) {
      const reader = new FileReader();

      reader.onload = function(event) {
        const imageURL = event.target.result;

        // Verificar si el archivo no es una imagen
        if (!file.type.startsWith('image/')) {
          // Ruta de la imagen por defecto
          const defaultImageURL = '../img/iconos/doc.png';
          img.style.objectFit = 'contain';
          img.src = defaultImageURL;
          imageContainer.setAttribute('data-image', defaultImageURL);
        } else {
          img.src = imageURL;
          imageContainer.setAttribute('data-image', imageURL);
        }
      }

      reader.readAsDataURL(file);
    }
  });
});

    </script>
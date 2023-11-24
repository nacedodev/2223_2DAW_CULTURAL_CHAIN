const inicio = () => {
    const nPais = document.getElementById('nombrepais');
    const imagen = document.getElementById('imagen');
    const send = document.getElementById('send');
  
    nPais.onblur = validarPais;
    imagen.onchange = validarImagen;
    send.onclick = validarForm;
  };
  const validarPais = (evento) => {
    const input = evento.target;
    const errorSpan = document.getElementById('centro-error');
    const regex = /^[A-Za-záéíóúñ\s]{3,40}$/;
  
    if (input.value.length >=40 ) {
      input.style.filter = 'drop-shadow(0 0 0.4em #FF4562)';
      errorSpan.textContent = 'El nombre del país no puede exceder los 40 caracteres.';
    } else if (!regex.test(input.value)) {
      input.style.filter = 'drop-shadow(0 0 0.4em #FF4562)';
      errorSpan.textContent = 'El nombre del país solo puede contener letras.';
    } else {
      input.style.filter = 'drop-shadow(0 0 0.2em lightgreen)';
      errorSpan.textContent = '';
    }
  };
  
  
  const validarImagen = () => {
    const imagen = document.getElementById('imagen');
    const errorSpan = document.getElementById('localidad-error');
    const allowedExtensions = ['jpg', 'jpeg', 'png'];
  
    if (imagen.files.length === 0) {
      errorSpan.textContent = 'Debe seleccionar una imagen.';
      return;
    }
  
    const fileName = imagen.files[0].name;
    const fileExtension = fileName.split('.').pop().toLowerCase();
  
    if (!allowedExtensions.includes(fileExtension)) {
      errorSpan.textContent = 'Formato de imagen no válido. Solo se permiten archivos JPG, JPEG o PNG.';
      imagen.style.filter = 'drop-shadow(0 0 0.4em #FF4562)';
    } else {
      errorSpan.textContent = '';
      imagen.style.filter = 'drop-shadow(0 0 0.2em lightgreen)';
    }
  };
  
  const validarForm = (e) => {
    e.preventDefault();
    const form = document.getElementById('form-end');
    const statusSpan = document.getElementById('status-message');
    const errorMessages = document.getElementsByClassName('error-message');
  
    let todosLosCamposLlenos = true;
    let todosLosCamposVacios = true;
  
    const nombrepaisInput = document.getElementById('nombrepais');
    const imagenInput = document.getElementById('imagen');
  
    validarPais({ target: nombrepaisInput });
  
    // Only validate the image if a file has been selected
    if (imagenInput.files.length > 0) {
      validarImagen();
    }
  
    if (nombrepaisInput.value !== '' || imagenInput.files.length > 0) {
      todosLosCamposVacios = false;
    } else {
      todosLosCamposLlenos = false;
    }
  
    const todosLosMensajesVacios = Array.from(errorMessages).every((errorMessage) => errorMessage.textContent === '');
  
    if (todosLosCamposLlenos && todosLosMensajesVacios) {
      statusSpan.textContent = '';
      form.style.animation = 'okAnimation 3s forwards';
  
      setTimeout(() => {
        form.style.animation = 'sendTop 1.8s forwards';
      }, 3000);
  
      setTimeout(() => {
        form.submit();
      }, 4500);
    } else if (todosLosCamposLlenos && !todosLosMensajesVacios) {
      statusSpan.textContent = 'Algún campo es incorrecto';
    } else if (todosLosCamposVacios) {
      statusSpan.textContent = 'Todos los campos están vacíos';
    } else {
      statusSpan.textContent = 'Hay algún campo vacío';
    }
  };
  
 
  
  
  window.onload = inicio;
  
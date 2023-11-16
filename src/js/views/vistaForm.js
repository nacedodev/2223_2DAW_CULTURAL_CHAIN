import { Vista } from "./vista.js"

export class VistaForm extends Vista{
    constructor(controlador,base){
        super(controlador,base)
        const nickname = document.getElementById("nickname");
        const correo = document.getElementById("correo");
        this.centro = document.getElementById("centro")
        const cp = document.getElementById("cp");
        this. localidad = document.getElementById('localidad')
        const send = document.getElementById('send')

        nickname.onblur = this.validarNick
        correo.onblur = this.validarEmail
        this.centro.onchange = this.validarSelectC
        this.localidad.onchange = this.validarSelectL
        cp.onblur = this.validarCP
        send.onclick = this.validarForm
    }

    validarNick = evento => {
        const input = evento.target;
        const errorSpan = document.getElementById("nickname-error");
        const regex = /^[A-Za-záéíóúñ0-9]{3,20}$/;


        if (!regex.test(input.value)) {
            input.style.filter = "drop-shadow(0 0 0.4em #FF4562)";
            errorSpan.textContent = "El nickname debe contener solo letras y tener entre 3 y 20 caracteres.";
        } else {
            input.style.filter = "drop-shadow(0 0 0.2em lightgreen)";
            errorSpan.textContent = "";
        }
    }

    validarEmail = evento => {
        const input = evento.target;
        const errorSpan = document.getElementById("correo-error");
        const regexCorreoGeneral = /^(\w{3,}\.?)*(\w{3,})@(\w{3,}\.?)*(\w{3,})\.[A-z]{2,}$/;
        const regexCorreoGuadalupe = /^(\w+(\.\w+)*\.)*guadalupe@alumnado\.fundacionloyola\.net$|^(?!.*@alumnado\.fundacionloyola\.es$)\w+@?fundacionloyola\.es$/;

        const centroSeleccionado = document.getElementById("centro").value;
    
        const regex = centroSeleccionado === "Virgen de Guadalupe" ? regexCorreoGuadalupe : regexCorreoGeneral;
    
        if (!regex.test(input.value)) {
        input.style.filter = "drop-shadow(0 0 0.4em #FF4562)";
        errorSpan.textContent = centroSeleccionado === "Virgen de Guadalupe" 
            ? "El formato del correo electrónico no coincice con el del Virgen de Guadalupe"
            : "El formato del correo electrónico no es válido.";
        } else {
        input.style.filter = "drop-shadow(0 0 0.2em lightgreen)";
        errorSpan.textContent = "";
        }
    }

    validarCP = evento => {
        const input = evento.target;
        const errorSpan = document.getElementById("cp-error");
    
        const localidadSeleccionada = document.getElementById("localidad").value;
        const codigoPostal = input.value;
        let regexCodigoPostal;
        let mensajeError = "";
    
        switch (localidadSeleccionada) {
        case "Badajoz":
        case "Merida":
            regexCodigoPostal = /^06\d{3}$/;
            break;
        case "Caceres": // Cáceres
            regexCodigoPostal = /^10\d{3}$/;
            break;
        case "Sevilla": // Sevilla
            regexCodigoPostal = /^41\d{3}$/;
            break;
        default:
            regexCodigoPostal = /^\d{5}$/;
            mensajeError = "El código postal debe estar compuesto por 5 dígitos";
            break;
        }
    
        if (!regexCodigoPostal.test(codigoPostal)) {
        input.style.filter = "drop-shadow(0 0 0.4em #FF4562)";
        errorSpan.textContent = mensajeError || `El código postal no coincide con la localidad seleccionada: ${localidadSeleccionada}`;
        } else {
        input.style.filter = "drop-shadow(0 0 0.2em lightgreen)";
        errorSpan.textContent = "";
        }
    }

     validarSelectC = evento => {
        const input = evento.target;
    
        if(input.selectedIndex === 0){
            input.style.filter = "drop-shadow(0 0 0.4em #FF4562)";
        }else{
            input.style.filter = "none";
        }
        if(correo.value != '') this.validarEmail({target:correo})
      }

    validarSelectL = evento => {
        const input = evento.target;
        
            if(input.selectedIndex === 0){
                input.style.filter = "drop-shadow(0 0 0.4em #FF4562)";
            }else{
                input.style.filter = "none";
            }
            if(cp.value != '') this.validarCP({target:cp})
    }
   
   validarForm = () => {
    const form = document.getElementById("form-end");
    const inputs = document.querySelectorAll("input");
    const selectCentros = document.querySelectorAll("select")[0]
    const selectLocalidad = document.querySelectorAll('select')[1]
    const statusSpan = document.getElementById('status-message')
    const errorMessages = document.getElementsByClassName('error-message');
  
    let todosLosCamposLlenos = true;
    let todosLosCamposVacios = true;
  
    inputs.forEach(input => {
      if (input.id === "nickname") {
          this.validarNick({ target: input });
      } else if (input.id === "correo") {
          this.validarEmail({ target: input });
      } else if (input.id === "cp") {
          this.validarCP({ target: input });
      } 

      if(selectCentros.selectedIndex === 0){
        selectCentros.style.filter = "drop-shadow(0 0 0.4em #FF4562)";
      }else{
        selectCentros.style.filter = "none";
      }

      if(selectLocalidad.selectedIndex === 0){
        selectLocalidad.style.filter = "drop-shadow(0 0 0.4em #FF4562)";
      }else{
        selectLocalidad.style.filter = "none";
      }
      
      if (input.value !== '') {
          todosLosCamposVacios = false;
      } else {
          todosLosCamposLlenos = false;
      }
    });
    const todosLosMensajesVacios = Array.from(errorMessages).every(errorMessage => errorMessage.textContent === '');
   
    if (todosLosCamposLlenos && todosLosMensajesVacios && this.centro.selectedIndex != 0 && this.localidad.selectedIndex != 0) {
        statusSpan.textContent = ''
        form.style.animation = 'okAnimation 3s forwards'
    
        setTimeout(function() {
            form.style.animation = 'sendTop 1.8s forwards'
            form.parentElement.style.animation = 'hideBG 2s forwards'
          }, 3000);

          setTimeout(function() {
              form.parentElement.style.display = 'none'
          }, 4800);
        
    }else if(todosLosCamposLlenos && !todosLosMensajesVacios){
        statusSpan.textContent = 'Algún campo es incorrecto'
    }else if (todosLosCamposVacios) {
        statusSpan.textContent = 'Todos los campos están vacíos';
    } else {
        statusSpan.textContent = 'Hay algún campo vacío';
    }
  };
    
}
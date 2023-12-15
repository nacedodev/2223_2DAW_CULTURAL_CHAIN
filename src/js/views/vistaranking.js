import { Vista } from './vista.js'
/**
 * Clase que representa la vista del ranking, que extiende de la clase `Vista`.
 * @extends Vista
 * @author Nacho - Antonio - Mario
 * @license MIT
 * @param {Object} controlador - El controlador asociado a la vista.
 * @param {HTMLElement} base - El elemento base de la vista.
 */
export class VistaRanking extends Vista {
  constructor (controlador, base) {
    super(controlador, base)

    /**
         * Elemento de botón para volver atrás.
         * @type {HTMLButtonElement}
         */
    const btnBack = this.base.querySelectorAll('button')[1]
    const btnTheme = this.base.querySelector('#vistaRanking #theme')
    
    this.divranking = document.getElementById('tablonranking')

    this.cargarRanking()
    // Asignar evento para ir a la vista principal al hacer clic en el botón de volver atrás
    btnBack.onclick = this.irMain
    btnTheme.onclick = this.changeTheme
  }
  /**
         * Realiza la navegación de vuelta a la vista principal.
         * @method
         */
  cargarRanking() {
    var arrayResultado = []; // Array para almacenar la información estructurada

    $.ajax({
        url: "php/ajaxranking.php",
        type: "GET",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: (data) => {
            // Iterar sobre los datos recibidos
            for (var i = 0; i < data.length; i++) {
                var otherData = data[i].otherData;

                // Estructurar los datos
                var elemento = {
                    nombre: otherData.nombre,
                    centro: otherData.centro,
                    localidad: otherData.localidad,
                    puntuacion: otherData.puntuacion
                };

                // Agregar el elemento al arrayResultado
                arrayResultado.push(elemento);
            }

            // Filtrar arrayResultado para obtener solo los centros
            this.aniadirRanking(arrayResultado)
        },
        error: function (status, error) {
            console.error("Error en la solicitud AJAX: " + status + " - " + error);
        }
    });
  }
  aniadirRanking(arrayResultado){
    arrayResultado.forEach((element, index) => {
      var nuevoDiv = document.createElement('div');
  
      // Agregar elementos con texto en mayúsculas al nuevoDiv
      nuevoDiv.innerHTML += "<p>" + (index + 1) + "</p>";
      nuevoDiv.innerHTML += "<p>" + arrayResultado[index]['nombre'].toUpperCase() + "</p>";
      nuevoDiv.innerHTML += "<p>" + arrayResultado[index]['centro'].toUpperCase() + "</p>";
      nuevoDiv.innerHTML += "<p>" + arrayResultado[index]['localidad'].toUpperCase() + "</p>";
      nuevoDiv.innerHTML += "<p>SCORE: </p>";
      nuevoDiv.innerHTML += "<p>" + arrayResultado[index]['puntuacion'].toUpperCase() + "</p>";
      nuevoDiv.innerHTML += "<img src='img/personajes/astronaut 1.png'>";
  
      // Añadir nuevoDiv al contenedor existente (divranking)
      this.divranking.appendChild(nuevoDiv);
  });
  }
  irMain = () => this.controlador.irAVista(this.controlador.vistaPrincipal)
}

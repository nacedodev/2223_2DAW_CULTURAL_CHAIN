import { Vista } from './vista.js'
/**
 * Clase que representa la vista principal del juego, que extiende de la clase `Vista`.
 * @extends Vista
 * @author Nacho - Antonio - Mario
 * @license MIT
 * @param {Object} controlador - El controlador asociado a la vista.
 * @param {HTMLElement} base - El elemento base de la vista.
 */
export class VistaPrincipal extends Vista {
  constructor (controlador, base) {
    super(controlador, base)

    this.asignarNames()

    const btnRestart = document.getElementById('restart')
    const btnRanking = this.base.querySelectorAll('button')[3]
    const btnSettings = this.base.querySelectorAll('button')[4]
    this.tablero = document.getElementById('divtablero')
    this.divIzq = document.getElementById('divizquierda')
    const personajes = this.base.querySelectorAll('.personaje')
    this.divPersonajes = document.getElementById('divderecha')
    this.info = this.base.querySelector('#info')
    this.end = this.base.querySelector('#end')
    this.form = document.getElementById('form-end')
    this.showForm = false

    // habilitamos la capacidad de hacer drag & drop a los personajes
    personajes.forEach(personaje => {
      personaje.addEventListener('dragstart', this.dragStart)
      personaje.addEventListener('dragend', this.dragEnd)
    })

    // Agregar eventos de arrastrar y soltar al tablero
    this.tablero.addEventListener('dragover', this.dragOver)
    this.tablero.addEventListener('dragenter', this.dragEnter)
    this.tablero.addEventListener('dragleave', this.dragLeave)
    this.tablero .addEventListener('drop', this.drop)
 
    this.tablero.style.backgroundImage = 'url("img/nivel/nivel1.jpg")';
    this.tablero.style.backgroundSize = 'cover';
    this.tablero.style.position = 'relative';
    this.tablero.style.opacity = '0.2';
    
  
   
    

    this.posX
    this.posY
    this.dir=null
    this.distanciapaso=5
    this.temp=0
    this.reload=50
    this.part=[]
    this.fila=0
    
  
    btnRanking.onclick = this.irRanking
    btnSettings.onclick = this.irSettings
    btnRestart.onclick = this.restartGame
    window.onkeydown = this.mostrarFormulario
  }

  /**
         * Realiza la navegación a la vista de configuración.
         * @method
         */
  irSettings = () => this.controlador.irAVista(this.controlador.vistaSettings)
  /**
         * Realiza la navegación al ranking.
         * @method
         */
  irRanking = () => this.controlador.irAVista(this.controlador.vistaRanking)
  /**
         * Controla la visualización del formulario cuando se presiona la tecla Enter.
         * @method
         * @param {Event} evento - El evento del teclado que activa la acción.
         */
  mostrarFormulario = evento => {
    if (evento.keyCode === 13 && this.showForm) {
      this.controlador.overlayForm(this.form)
      this.showForm = false
    }
  }

  asignarNames () {
    const figcaptions = document.querySelectorAll('figcaption')

    const names = this.controlador.devolverNames()
    for (let i = 0; i < figcaptions.length; i++) {
      if (i < names.length) {
        figcaptions[i].innerText = names[i]
      } else {
        figcaptions[i].innerText = ''
      }
    }
  }

  /**
     * Reinicia el juego, eliminando todos los personajes del tablero y restableciendo los elementos de animación y visualización.
     * @method
     */
  restartGame = () => {
    // Remove all the characters from the tablero
    const personajes = this.tablero.querySelectorAll('.personaje')
    personajes.forEach(personaje => {
      personaje.remove()
    })
    
    // Reset the animations and display elements
    this.divPersonajes.style.animation = 'none'
    this.divIzq.style.animation = 'none'
    this.divPersonajes.style.display = 'block'
    this.divIzq.style.display = 'block'
    this.info.style.animation = 'none'
    this.end.style.animation = 'none'
    this.form.style.animation = 'none'
    this.tablero.style.filter = 'none'
    this.tablero.style.backgroundImage='none'
    this.divPersonajes.style.pointerEvents = 'auto'


    

    this.tablero.style.backgroundImage = 'url("img/nivel/nivel1.jpg")';
    this.tablero.style.backgroundSize = 'cover';
    this.tablero.style.position = 'relative';
    this.tablero.style.opacity = '0.2';

  
    while (this.tablero.firstChild) {
      this.tablero.removeChild(this.tablero.firstChild);
  }
   while (this.part[0].firstChild) {
    this.part[0].removeChild(this.part[0].firstChild);
  }
    this.temp=0
    this.dir=null
    clearInterval(this.intervalo);
    // Reset the showForm variable
    this.showForm = false
  }

  /**
     * Gestiona el evento dragStart para el personaje: cambia la opacidad y el filtro, y establece los datos de transferencia.
     * @method
     * @param {DragEvent} e - El evento de arrastre (dragStart).
     */
  dragStart (e) {
    this.style.opacity = '1'
    this.style.filter = 'drop-shadow(0px 0px 15px #000)'
    e.dataTransfer.setData('text/plain', e.target.id)
    
  }

  /**
     * Gestiona el evento dragEnd para el personaje: restablece la opacidad y el filtro.
     * @method
     * @param {DragEvent} e - El evento de arrastre (dragEnd).
     */
  dragEnd (e) {
    this.style.opacity = '1'
    this.style.filter = 'none'
    
  }

  /**
     * Gestiona el evento dragOver para el tablero: previene el comportamiento predeterminado y aplica un filtro de sombra.
     * @method
     * @param {DragEvent} e - El evento de arrastre (dragOver).
     */
  dragOver (e) {
    e.preventDefault()
    this.style.filter = 'drop-shadow(0px 0px 8px rgba(0, 0, 0, 0.5))'
  }

  /**
     * Gestiona el evento dragEnter para el tablero: previene el comportamiento predeterminado y aplica un filtro de sombra.
     * @method
     * @param {DragEvent} e - El evento de arrastre (dragEnter).
     */
  dragEnter (e) {
    e.preventDefault()
    this.style.filter = 'drop-shadow(0px 0px 8px rgba(0, 0, 0, 0.5))'
    
  }

  /**
     * Gestiona el evento dragLeave para el tab ```javascript
     * Gestiona el evento dragLeave para el tablero: elimina el filtro de sombra.
     * @method
     */
  dragLeave () {
    this.style.filter = 'none'
  }

  /**
     * Gestiona el evento drop para el tablero: previene el comportamiento predeterminado, obtiene el ID del personaje arrastrado y clonado, establece las coordenadas de posición y agrega el personaje al tablero.
     * @method
     * @param {DragEvent} e - El evento de arrastre (drop).
     */
  drop = (e) => {
    e.preventDefault();
    
    const personajeId = e.dataTransfer.getData('text/plain');
    const personaje = document.getElementById(personajeId);

    const personajeSelected = personaje.cloneNode(true);

    
    this.showForm = true;
    this.tablero.style.filter = 'none'; // Restaurar el fondo a su estado original
    this.divPersonajes.style.animation = 'disappearRight 2s forwards';
    this.divIzq.style.animation = 'enlargeBoard 2s forwards';
    personajeSelected.style.pointerEvents = 'none';
    this.divPersonajes.style.pointerEvents = 'none';
    this.info.style.animation = 'ocultarTexto 1.5s forwards';
    this.end.style.animation = 'mostrarTexto 4s forwards';
   
   
        this.tablero.style.transition = 'opacity 1s';  // Transición de 1 segundo en la opacidad
        this.tablero.style.opacity = '1';  // Establecer la opacidad a 1 para mostrar la imagen
   

  
    // Obtener las coordenadas del evento de soltar en relación con el tablero
    this.posX = e.clientX - this.tablero.getBoundingClientRect().left;
    this.posY = e.clientY - this.tablero.getBoundingClientRect().top;
    
    
    this.part.push(personajeSelected);
    this.tablero.appendChild(this.part[0]);
    this.part[0].style.position='absolute'
    // Establecer las coordenadas de posición del personaje
    this.part[0].style.left = this.posX + 'px';
    this.part[0].style.top = this.posY + 'px';
    this.part[0].style.border='solid black 2px'

    // Agregar el personaje al tablero
 
    window.addEventListener('keydown',this.direccion);
    
    this.intervalo = setInterval(() => this.moverObjeto(), this.reload);
}

avanzar=()=> {

  if (this.dir == 1) {
      this.part[0].style.top = this.posY - this.distanciapaso + "px";
      this.posY = this.posY - this.distanciapaso;
  }
  if (this.dir == 2) {
      this.part[0].style.left = this.posX + this.distanciapaso + "px";
      this.posX =  this.posX + this.distanciapaso;
  }
  if (this.dir == 3) {
      this.part[0].style.top = this.posY + this.distanciapaso + "px";
      this.posY = this.posY + this.distanciapaso;
  }
  if (this.dir == 4) {
      this.part[0].style.left = this.posX - this.distanciapaso + "px";
      this.posX = this.posX - this.distanciapaso;
  }
  //animacion();  // Actualizar la animación de la this.part[0]
}
direccion=(event)=> {
  if (event.key == "w") this.dir = 1;
  if ( event.key== "d") this.dir = 2;
  if ( event.key== "s") this.dir = 3;
  if (event.key== "a") this.dir = 4;
 
}
moverObjeto =()=> {
  for (let i = this.fila; i > 0; i--) {
    // Mover cada parte de la serpiente a la posición de la parte anterior
    this.part[i].style.left = this.part[i - 1].offsetLeft + 'px';
    this.part[i].style.top = this.part[i - 1].offsetTop + 'px';
}

  this.avanzar();  // Mover la this.part[0]
  this.limites();
  this.generacionPersonas();
  this.recogerImagen();
  this.temp++;
  

}
 limites=()=> {
      // Obtener las dimensiones reales del tablero
      var tableroAncho = this.tablero.clientWidth;
      var tableroAlto = this.tablero.clientHeight;

    // Establecer límite derecho
    if (this.posX > tableroAncho-25) {
        this.posX = 0
    }
    if (this.posX < 0) {
      this.posX = tableroAncho-25
    }

    if (this.posY > tableroAlto-25) {
      this.posY = 0
    }

    // Establecer límite superior
    if (this.posY < 0) {

      this.posY = tableroAlto-25
     
    }
  }

  generacionPersonas = () => {
  if (this.temp % 100 === 0) {
    var tableroAncho = this.tablero.clientWidth;
    var tableroAlto = this.tablero.clientHeight;

    // Crear un nuevo elemento img en lugar de div
    var nuevaImagen = document.createElement('img');

    var numeroAleatorio = Math.floor(Math.random() * 15) + 1;
    var numeroFormateado = ('00' + numeroAleatorio).slice(-3);

    // Crear la URL de la imagen utilizando el número formateado
   
    nuevaImagen.src = 'img/personajes/person'+ numeroFormateado + '.png';;

    // Establecer el estilo del borde de la nueva imagen
    nuevaImagen.style.border = 'solid 2px black';

    // Calcular posiciones aleatorias dentro del tablero
    var posX = Math.floor(Math.random() * tableroAncho) ;
    var posY = Math.floor(Math.random() * tableroAlto);

    // Establecer la posición absoluta de la nueva imagen dentro del tablero
    nuevaImagen.style.position = 'relative';
    nuevaImagen.style.left = posX + 'px';
    nuevaImagen.style.top = posY + 'px';
   

    // Añadir la nueva imagen al elemento con el id 'tablero'
    this.tablero.appendChild(nuevaImagen);
   
  }
 
}
recogerImagen = () => {
  // Detectar el objeto (imagen) en las coordenadas actuales del this.part[0]
  var objetoEnPunto = document.elementFromPoint(
    this.part[0].getBoundingClientRect().left + this.part[0].offsetWidth / 2,
    this.part[0].getBoundingClientRect().top + this.part[0].offsetHeight / 2
  );

  if (objetoEnPunto && objetoEnPunto.tagName === 'IMG') {
    // Crear una nueva imagen en lugar de clonarla
    var imagenRecogida = new Image();
    imagenRecogida.src = objetoEnPunto.src;

    // Ocultar la imagen original
    objetoEnPunto.style.display = 'none';

    // Añadir la imagen recogida al final de la cola de la serpiente
    this.part.push(imagenRecogida);
    this.fila++;

    // Calcular la posición con un espacio entre cada imagen (ajusta el valor según sea necesario)
    var espacioEntreImagenes = 25; // Puedes ajustar este valor según tu preferencia
    var nuevaPosicionLeft = parseInt(this.part[this.fila - 1].style.left, 10) + this.part[0].offsetWidth + espacioEntreImagenes;

    // Ajustar la posición de la nueva imagen en relación con la imagen anterior
    this.part[this.fila].style.position = 'absolute';
    this.part[this.fila].style.left = nuevaPosicionLeft + 'px';
    this.part[this.fila].style.top = this.part[0].style.top;
    this.part[this.fila].style.border = 'solid black 2px';

    this.tablero.appendChild(this.part);
  } else {
    console.log('No hay ninguna imagen para recoger en estas coordenadas.');
  }
};




}

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
  /**
   * Constructor de la clase VistaPrincipal.
   * @constructor
   * @param {Object} controlador - El controlador asociado a la vista.
   * @param {HTMLElement} base - El elemento base de la vista.
   */
  constructor (controlador, base) {
    super(controlador, base)

    this.asignarNames()

    const btnRestart = document.getElementById('restart')
    const btnRanking = this.base.querySelectorAll('button')[3]
    const btnSettings = this.base.querySelectorAll('button')[4]
    this.hora = document.getElementById('hora')
    this.puntuacion = document.getElementById('puntuacion')
    this.btnTheme = this.base.querySelector('#theme')
    this.tablero = document.getElementById('divtablero')
    this.divIzq = document.getElementById('divizquierda')
    this.gameStarted = false
    this.clickerMode = false
    const personajes = this.base.querySelectorAll('.personaje')
    this.divPersonajes = document.getElementById('divderecha')
    this.titulo = document.getElementById('titulo')
    this.info = this.base.querySelector('#info')
    this.end = this.base.querySelector('#end')
    this.form = document.getElementById('form-end')
    this.logo = this.base.querySelector('#logo')
    this.showForm = false

    this.tablero.style.position = 'relative'

    this.score = 0
    this.puntuacion.textContent = '0' + this.score

    this.puntuacion = document.getElementById('puntuacion')
    this.posX
    this.posY
    this.dir = null
    this.distanciapaso = 1
    this.temp = 0
    this.reload = 10
    this.part = []
    this.fila = 0
    this.score = 0
    this.personita
    this.tiempo

    // habilitamos la capacidad de hacer drag & drop a los personajes
    personajes.forEach(personaje => {
      personaje.addEventListener('dragstart', this.dragStart)
      personaje.addEventListener('dragend', this.dragEnd)
    })

    // Agregar eventos de arrastrar y soltar al tablero
    this.tablero.addEventListener('dragover', this.dragOver)
    this.tablero.addEventListener('dragenter', this.dragEnter)
    this.tablero.addEventListener('dragleave', this.dragLeave)
    this.tablero.addEventListener('drop', this.drop)

    btnRanking.onclick = this.irRanking
    btnSettings.onclick = this.irSettings
    this.btnTheme.onclick = this.changeTheme
    btnRestart.onclick = this.restartGame
    this.logo.onclick = this.clickerButtonActions
    window.onkeydown = this.mostrarFormulario

    window.getComputedStyle(this.hora).display === 'none' ? this.clickerMode = false : this.clickerMode = true

    this.setConfetti(this.clickerMode)
    setInterval(this.mostrarHora, 1000)
  }

  setConfetti = (clicker) => {
    console.log(clicker)
    if (clicker) {
      const confetti = new Confetti('logo')
      confetti.setCount(100)
      confetti.setSize(1)
      confetti.setPower(5)
      confetti.setFade(true)
      confetti.destroyTarget(false)
    } else {
      const confetti = new Confetti('logo')
      confetti.setCount(1200)
      confetti.setSize(1.6)
      confetti.setPower(50)
      confetti.setFade(false)
      confetti.destroyTarget(true)
    }
  }

  /**
   * Realiza la navegación a la vista de configuración.
   * @method
  */
  irSettings = () => {
    this.controlador.irAVista(this.controlador.vistaSettings)
    this.divIzq.style.animation = 'none'
    this.divPersonajes.style.animation = 'none'
    this.info.style.animation = 'none'
    this.titulo.style.animation = 'none'
  }

  /**
   * Realiza la navegación al ranking.
   * @method
  */
  irRanking = () => {
    this.controlador.irAVista(this.controlador.vistaRanking)
    this.divIzq.style.animation = 'none'
    this.divPersonajes.style.animation = 'none'
    this.info.style.animation = 'none'
    this.titulo.style.animation = 'none'
  }

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

  mostrarHora () {
    const fecha = new Date()
    let hora = fecha.getHours()
    let minutos = fecha.getMinutes()

    // Asegúrate de que los números siempre tengan dos dígitos
    if (hora < 10) hora = '0' + hora
    if (minutos < 10) minutos = '0' + minutos

    const horaActual = hora + ':' + minutos

    // Actualiza el contenido del elemento HTML con la hora actual
    this.hora.innerHTML = horaActual
  }

  clickerButtonActions = (e) => {
    const target = e.target
    if (!this.clickerMode) {
      // Aplicar transición de opacidad
      target.style.transition = 'opacity 2s ease'
      target.style.opacity = 0

      setTimeout(() => {
        target.style.visibility = ''
        target.style.opacity = 1
      }, 5000)
    } else {
      clearTimeout(this.timeout)

      target.style.animation = 'clickerOpacityIn 1s forwards'
      this.score += 10
      this.puntuacion.textContent = this.score.toString().padStart(2, '0')

      this.timeout = setTimeout(() => {
        target.style.animation = 'clickerOpacityOut 4s forwards'
        this.score = 0
        this.puntuacion.textContent = '00'
      }, 3000)
    }
  }

  /**
   * Reinicia el juego, eliminando todos los personajes del tablero y restableciendo los elementos de animación y visualización.
   * @method
  */
  restartGame = () => {
    // Remove all the characters from the tablero
    if (this.gameStarted) {
      const personajes = this.tablero.querySelectorAll('.personaje')
      personajes.forEach(personaje => {
        personaje.remove()
      })
      while (this.tablero.firstChild) {
        this.tablero.removeChild(this.tablero.firstChild)
      }
      while (this.part[0].firstChild) {
        this.part[0].removeChild(this.part[0].firstChild)
      }
      // Reset the animations and display elements
      this.divIzq.style.animation = 'shortBoard 1s forwards'
      this.divPersonajes.style.animation = 'appearRight 1s forwards'
      this.info.style.animation = 'mostrarTexto 1s forwards'
      this.titulo.style.animation = 'mostrarTexto 1s forwards'
      this.end.style.animation = 'none'
      this.form.style.animation = 'none'
      this.tablero.style.filter = 'none'
      this.divPersonajes.style.pointerEvents = 'auto'

      // Reset the showForm variable
      this.showForm = false
      this.gameStarted = false
      this.posX
      this.posY
      this.dir = -1
      this.distanciapaso = 1
      this.temp = 1
      this.reload = 25

      this.fila = 0
      this.score = 0
      this.puntuacion.textContent = '0' + this.score
      clearInterval(this.intervalo)
      // Reset the showForm variable

      this.gameStarted = false
    } else {
      const restartImg = document.querySelector('#restart > img')
      restartImg.style.animation = 'shakeAnimation 0.3s ease-in-out'
      setTimeout(() => {
        restartImg.style.animation = 'none'
      }, 300)
    }
  }

  /**
     * Gestiona el evento dragStart para el personaje: cambia la opacidad y el filtro, y establece los datos de transferencia.
     * @method
     * @param {DragEvent} e - El evento de arrastre (dragStart).
     */
  dragStart (e) {
    this.style.opacity = '0.6'
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
    e.preventDefault()
    this.part = []
    const personajeId = e.dataTransfer.getData('text/plain')
    const personaje = document.getElementById(personajeId)

    const personajeSelected = personaje.cloneNode(true)

    // Obtener las coordenadas del evento de soltar en relación con el tablero

    const boardRect = this.tablero.getBoundingClientRect()
    this.posX = ((e.clientX - boardRect.left) / boardRect.width) * 100
    this.posY = ((e.clientY - boardRect.top) / boardRect.height) * 100

    // Establecer las coordenadas de posición del personaje
    this.part.push(personajeSelected)
    this.tablero.appendChild(this.part[0])
    this.part[0].style.position = 'absolute'
    // Establecer las coordenadas de posición del personaje
    this.part[0].style.left = this.posX + '%'
    this.part[0].style.top = this.posY + '%'

    // Agregar el personaje al tablero
    this.showForm = true
    this.tablero.style.filter = 'none' // Restaurar el fondo a su estado original
    this.divPersonajes.style.animation = 'disappearRight 1s forwards'
    this.divIzq.style.animation = 'enlargeBoard 1.5s forwards'
    this.titulo.style.animation = 'ocultarTexto 0.5s forwards'
    personajeSelected.style.pointerEvents = 'none'
    personajeSelected.style.opacity = '1'
    personajeSelected.style.width = '2.3%'
    this.divPersonajes.style.pointerEvents = 'none'
    this.info.style.animation = 'ocultarTexto 1.5s forwards'
    this.end.style.animation = 'mostrarTexto 4s forwards'
    this.gameStarted = true
    window.addEventListener('keydown', this.direccion)
    window.addEventListener('touchstart', this.direccion)
    this.intervalo = setInterval(() => this.update(), this.reload)
    this.temp = 1
  }

  /**
   * Mueve el objeto (imagen) en el juego hacia adelante según la dirección actual.
   * @method
   */
  avanzar = () => {
    if (this.dir === 1) {
      this.part[0].style.top = this.posY - this.distanciapaso + '%'
      this.posY = this.posY - this.distanciapaso
    }
    if (this.dir === 2) {
      this.part[0].style.left = this.posX + this.distanciapaso + '%'
      this.posX = this.posX + this.distanciapaso
    }
    if (this.dir === 3) {
      this.part[0].style.top = this.posY + this.distanciapaso + '%'
      this.posY = this.posY + this.distanciapaso
    }
    if (this.dir === 4) {
      this.part[0].style.left = this.posX - this.distanciapaso + '%'
      this.posX = this.posX - this.distanciapaso
    }
  // animacion();  // Actualizar la animación de la this.part[0]
  }

  /**
   * Maneja la dirección del objeto (imagen) en el juego en función de la entrada del usuario.
   * @method
   * @param {Event} event - El evento de teclado o táctil que activa la acción.
   */
  direccion = (event) => {
    if (event.key == 'w' && this.dir != 3) this.dir = 1
    if (event.key == 'd' && this.dir != 4) this.dir = 2
    if (event.key == 's' && this.dir != 1) this.dir = 3
    if (event.key == 'a' && this.dir != 2) this.dir = 4

    // Verifica si el evento es táctil
    if (event.touches && event.touches.length > 0) {
    // Obtén las coordenadas x del toque
      const touchX = event.touches[0].clientX

      // Obtiene el ancho total de la pantalla
      const screenWidth = window.innerWidth

      // Si el toque fue en la mitad izquierda, resta 1 a dir; si fue en la mitad derecha, suma 1 a dir
      this.dir = touchX < screenWidth / 2 ? (this.dir === 1 ? 4 : this.dir - 1) : this.dir === 4 ? 1 : this.dir + 1

      // Asegura que dir esté en el rango de 1 a 4
      if (this.dir > 4) {
        this.dir = 1
      } else if (this.dir < 1) {
        this.dir = 4
      }
    }
  }

  /**
   * Mueve el objeto (imagen) en el juego y realiza diversas acciones según el estado del juego.
   * @method
   */
  update = () => {
    if(this.dir>0){
      for (let i = this.fila; i > 0; i--) {
        // Mover cada parte de la serpiente a la posición de la parte anterior
        this.part[i].style.left = this.part[i - 1].style.left
        this.part[i].style.top = this.part[i - 1].style.top
      }
      for (let i = 1; i < this.fila; i++) {
        if (this.part[0].style.left == this.part[i + 1].style.left && this.part[0].style.top == this.part[i + 1].style.top) { this.restartGame() }
      }
      this.avanzar() // Mover la this.part[0]
      this.limites()
      this.generacionPersonas()
      this.hueco()
      this.recogerPersona()
      this.generacionBanderas()
      this.temp++
    }
  }
  /**
   * Aplica límites al objeto (imagen) en el juego para que no salga del tablero.
   * @method
   */
  limites = () => {
    // Obtener las dimensiones reales del tablero
    const tableroAncho = this.tablero.clientWidth
    const tableroAlto = this.tablero.clientHeight

    // Convertir porcentaje a píxeles
    const posXPixels = (this.posX / 100) * tableroAncho
    const posYPixels = (this.posY / 100) * tableroAlto

    // Establecer límite derecho
    if (posXPixels > tableroAncho - 15) {
      this.posX = 0
    }
    if (posXPixels < 0) {
      this.posX = 99
    }

    // Establecer límite inferior
    if (posYPixels > tableroAlto - 40) {
      this.posY = 0
    }

    // Establecer límite superior
    if (posYPixels < 0) {
      this.posY = 95
    }
  }

  /**
 * Genera personas de manera aleatoria en el tablero.
 */
  generacionPersonas = () => {
    if (this.temp % 10 === 0) {
      const tableroAncho = this.tablero.clientWidth-this.part[0].offsetWidth*2
      const tableroAlto = this.tablero.clientHeight-this.part[0].offsetHeight*2

      // Crear un nuevo elemento img en lugar de div
      const nuevaImagen = document.createElement('img')
      nuevaImagen.style.width = '2.3%'

      const numeroAleatorio = Math.floor(Math.random() * 15) + 1
      const numeroFormateado = ('00' + numeroAleatorio).slice(-3)

      // Crear la URL de la imagen utilizando el número formateado

      nuevaImagen.src = 'img/personajes/person' + numeroFormateado + '.png'

      // Establecer el estilo del borde de la nueva imagen

      // Calcular posiciones aleatorias dentro del tablero
      const posX = Math.floor(Math.random() * tableroAncho - 10)
      const posY = Math.floor(Math.random() * tableroAlto - 10)

      // Establecer la posición absoluta de la nueva imagen dentro del tablero
      nuevaImagen.style.position = 'absolute'
      nuevaImagen.style.left = posX+this.part[0].offsetWidth + 'px'
      nuevaImagen.style.top = posY+this.part[0].offsetHeight+ 'px'
      nuevaImagen.classList.add('generado')

      // Añadir la nueva imagen al elemento con el id 'tablero'
      this.tablero.appendChild(nuevaImagen)
    }
  }

  /**
 * Genera banderas de manera aleatoria en el tablero.
 */
  generacionBanderas = () => {
    if (this.temp % 500 === 0) {
      var tableroAncho = this.tablero.clientWidth;
      var tableroAlto = this.tablero.clientHeight;
  
      // Crear un nuevo elemento img en lugar de div
      var nuevaBandera = document.createElement('img');
  
      // Crear la URL de la imagen utilizando el número formateado
      nuevaBandera.src = 'img/objetos/bandera.png';
  
      // Calcular posiciones aleatorias como porcentaje del tamaño del tablero
      var posXPercentage = Math.random() * 100;
      var posYPercentage = Math.random() * 100;
  
      // Convertir porcentajes a píxeles utilizando el tamaño del tablero
      var posX = (posXPercentage / 100) * tableroAncho - 10;
      var posY = (posYPercentage / 100) * tableroAlto - 10;
  
      // Establecer la posición y tamaño de la nueva bandera en porcentajes
      nuevaBandera.style.position = 'absolute';
      nuevaBandera.style.height = '4%';  // Cambia este valor según tus preferencias
      nuevaBandera.style.width = '4%';   // Cambia este valor según tus preferencias
      nuevaBandera.style.left = posXPercentage + '%';
      nuevaBandera.style.top = posYPercentage + '%';
      nuevaBandera.classList.add('bandera');
  
      // Añadir la nueva bandera al elemento con el id 'tablero'
      this.tablero.appendChild(nuevaBandera);
    }
  }

  /**
 * Recoge la persona en la posición actual y actualiza la puntuación.
 */
  recogerPersona = () => {
  // Detectar el objeto (imagen) en las coordenadas actuales del this.part[0]
    const objetoEnPunto = this.detectarcolision()

    if (objetoEnPunto && objetoEnPunto.className === 'generado') {
      this.score = this.score + 10
      this.puntuacion.textContent = '' + this.score
      const imagenRecogida = new Image()
      imagenRecogida.style.width = '2.3%'

      imagenRecogida.src = objetoEnPunto.src
      this.personita = imagenRecogida
      this.tiempo = this.temp
      // Remove de la imagen cogida
      objetoEnPunto.remove()

    // Añadir la imange recogida al final de la cola de la serpiente
    };

    if (objetoEnPunto && objetoEnPunto.className === 'bandera') {
      this.score += 50
      this.puntuacion.textContent = '' + this.score
      objetoEnPunto.remove()
    }
  }

  /**
 * Une una imagen al final de la fila en el tablero.
 * @param {Image} imagen - La imagen que se va a unir.
 */
  unir = (imagen) => {
    this.fila++
    this.part.push(imagen)
    this.tablero.appendChild(this.part[this.fila])

    // Calcular la posición con un espacio entre cada imagen (ajusta el valor según sea necesario)
    const nuevaPosicionLeft = parseInt(this.part[this.fila - 1].style.left, 10) + this.part[0].offsetWidth

    // Ajustar la posición de la nueva imagen en relación con la imagen anterior
    this.part[this.fila].style.position = 'absolute'
    this.part[this.fila].style.left = nuevaPosicionLeft + 'px'
    this.part[this.fila].style.top = this.part[0].style.top

    this.tablero.appendChild(this.part[this.fila])
  }

  /**
 * Crea un hueco en la fila después de un tiempo determinado.
 */
  hueco = () => {
    if (this.temp == this.tiempo + 1) {
      this.unir(new Image())
    }
    if (this.temp == this.tiempo + 2) {
      this.unir(this.personita)
    }
  }
  detectarcolision = () => {
    var punto = [];

    punto[0] = document.elementFromPoint(
        this.part[0].getBoundingClientRect().left + this.part[0].offsetWidth,
        this.part[0].getBoundingClientRect().top + this.part[0].offsetHeight
    );
    punto[1] = document.elementFromPoint(
        this.part[0].getBoundingClientRect().left + this.part[0].offsetWidth,
        this.part[0].getBoundingClientRect().top
    );
    punto[2] = document.elementFromPoint(
        this.part[0].getBoundingClientRect().left,
        this.part[0].getBoundingClientRect().top + this.part[0].offsetHeight
    );
    punto[3] = document.elementFromPoint(
        this.part[0].getBoundingClientRect().left,
        this.part[0].getBoundingClientRect().top
    );

    for (let i = 0; i < 4; i++) {
        if (punto[i] && punto[i].classList.contains('generado')) {
            return punto[i];
        }
    }

    return false;
}
}

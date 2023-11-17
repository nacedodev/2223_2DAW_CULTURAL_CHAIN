import { Vista } from "./vista.js"

export class VistaPrincipal extends Vista{
    constructor(controlador , base){
        super(controlador,base)

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
            personaje.addEventListener('dragstart', this.dragStart);
            personaje.addEventListener('dragend', this.dragEnd);
        });

        // Agregar eventos de arrastrar y soltar al tablero
        this.tablero.addEventListener('dragover', this.dragOver);
        this.tablero.addEventListener('dragenter', this.dragEnter);
        this.tablero.addEventListener('dragleave', this.dragLeave);
        this.divIzq.addEventListener('drop', this.drop);

        btnRanking.onclick = this.irRanking
        btnSettings.onclick = this.irSettings
        btnRestart.onclick = this.restartGame
        window.onkeydown = this.mostrarFormulario
    }

    irSettings = () => this.controlador.irAVista(this.controlador.vistaSettings)
    irRanking = () => this.controlador.irAVista(this.controlador.vistaRanking)
     
    mostrarFormulario = evento => {
        if (evento.keyCode === 13 && this.showForm) {
          this.controlador.overlayForm(this.form);
          this.showForm = false;
        }
      }
      
      asignarNames(){
        const figcaptions = document.querySelectorAll('figcaption');

        let names = this.controlador.devolverNames()
        for (let i = 0; i < figcaptions.length; i++) {
            if (i < names.length) {
              figcaptions[i].innerText = names[i];
            } else {
              figcaptions[i].innerText = '';
            }
          }
      }

      restartGame = () => {
        // Remove all the characters from the tablero
        const personajes = this.tablero.querySelectorAll('.personaje');
        personajes.forEach(personaje => {
            personaje.remove();
        });
    
        // Reset the animations and display elements
        this.divPersonajes.style.animation = 'none';
        this.divIzq.style.animation = 'none';
        this.divPersonajes.style.display = 'block';
        this.divIzq.style.display = 'block';
        this.info.style.animation = 'none';
        this.end.style.animation = 'none';
        this.form.style.animation = 'none';
        this.tablero.style.filter = 'none';
    
        // Reset the showForm variable
        this.showForm = false;
      }
    

    dragStart(e){
        this.style.opacity = '0.6'
        this.style.filter = 'drop-shadow(0px 0px 15px #000)';
        e.dataTransfer.setData('text/plain', e.target.id);
    }

    dragEnd(e){
        this.style.opacity = '1'
        this.style.filter = 'none'
    }

    dragOver(e){
        e.preventDefault()
        this.style.filter = 'drop-shadow(0px 0px 8px rgba(0, 0, 0, 0.5))';
    }

    dragEnter(e) {
        e.preventDefault();
        this.style.filter = 'drop-shadow(0px 0px 8px rgba(0, 0, 0, 0.5))';
    }

    dragLeave() {
        this.style.filter = 'none'
    }

    drop = (e) => {
        e.preventDefault();
        const personajeId = e.dataTransfer.getData('text/plain');
        const personaje = document.getElementById(personajeId);

        const personajeSelected = personaje.cloneNode(true);
        
        // Obtener las coordenadas del evento de soltar en relación con el tablero
        
        const dropX = e.clientX - 15
        const dropY = e.clientY - parseInt(window.getComputedStyle(this.divIzq).marginTop) - 10
        
        //Establecer las coordenadas de posición del personaje
        personajeSelected.style.left = dropX + 'px';
        personajeSelected.style.position = 'absolute';
        personajeSelected.style.top = dropY + 'px';

        
        // Agregar el personaje al tablero
        this.tablero.appendChild(personajeSelected);
        this.showForm = true
        this.tablero.style.filter = 'none'; // Restaurar el fondo a su estado original
        this.divPersonajes.style.animation = 'disappearRight 2s forwards'
        this.divIzq.style.animation = 'enlargeBoard 2s forwards'
        personajeSelected.style.pointerEvents = 'none';
        this.info.style.animation = 'ocultarTexto 1.5s forwards'
        this.end.style.animation = 'mostrarTexto 4s forwards'
    }
}
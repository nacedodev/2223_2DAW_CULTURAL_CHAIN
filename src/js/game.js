import { VistaPrincipal } from './views/vistaPrincipal.js'
import { VistaSettings } from './views/vistaSettings.js';
import { VistaRanking } from './views/vistaRanking.js';

class Game {

     
    constructor() {

        const div1 = document.getElementById('vistaPrincipal')
        const div2 = document.getElementById('vistaSettings')
        const div3 = document.getElementById('vistaRanking')

        this.vistaPrincipal = new VistaPrincipal(this,div1)
        this.vistaSettings = new VistaSettings(this,div2)
        this.vistaRanking = new VistaRanking(this,div3)

        this.vistas = [this.vistaPrincipal, this.vistaSettings, this.vistaRanking];

        this.irAVista(this.vistaPrincipal)
    }

    ocultarVistas(){
        this.vistas.forEach(vista => {
            vista.mostrar(false)
        });
	}

    irAVista(vista) {
        this.ocultarVistas()
        vista.mostrar(true);
    }
}

// Crear una instancia de la clase Game
window.onload = () => new Game()

import { VistaPrincipal } from './views/vistaPrincipal.js'
import { VistaSettings } from './views/vistaSettings.js';
import { VistaRanking } from './views/vistaRanking.js';
import { VistaForm } from './views/vistaForm.js';
import { ModeloNames } from './models/modeloNames.js';
import { ModeloConfig } from './models/modeloConfig.js';

class Game {
    constructor() {

        const div1 = document.getElementById('vistaPrincipal')
        const divForm = document.getElementById('vistaForm')
        const div2 = document.getElementById('vistaSettings')
        const div3 = document.getElementById('vistaRanking')

        this.modelNames = new ModeloNames()
        this.ModelConfig = new ModeloConfig()

        // Nombres de los personajes
        const nombres = ['Kai', 'Jake', 'Baku','Pauline','Ayara','Logan','Manu','Eva','Nalani','Michael'];
        this.almacenarNames(nombres)

        const configs = ['fácil','muted']
        this.almacenarConfig(configs)

        this.vistaPrincipal = new VistaPrincipal(this,div1)
        this.vistaSettings = new VistaSettings(this,div2)
        this.vistaRanking = new VistaRanking(this,div3)
        this.vistaForm = new VistaForm(this,divForm)

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

    almacenarNames(nombres){
        // Itera sobre la lista de nombres y guárdalos en el modelo
        nombres.forEach(nombre => {
            this.modelNames.guardarName(nombre, nombre);
        });
    }

    almacenarConfig(configs){
        configs.forEach(config => {
            this.ModelConfig.guardarConfig(config,config)
        })
    }

    devolverNames() {
        const result = [];
      
        this.modelNames.mapa.forEach((value, key) => {
          const name = this.modelNames.verName(key);
          result.push(name);
        });
      
        return result;
      }
    
    overlayForm(form) {
        this.vistaForm.base.style.animation = 'blurBG 1s forwards';
        form.style.animation = 'mostrarForm 2s forwards';
    }
}

// Crear una instancia de la clase Game
window.onload = () => new Game()

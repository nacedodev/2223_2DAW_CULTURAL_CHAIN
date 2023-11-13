import {Vista1} from './views/vista1.js'
import { Vista2 } from './views/vista2.js';
import { Vista3 } from './views/vista3.js';
class Game {
    constructor() {
        this.vistas = document.getElementsByClassName('vista');
        this.inicializarBotones()
        this.vista1 = new Vista1()
        this.vista2 = new Vista2()
        this.vista3 = new Vista3()
    }
    
    inicializarBotones() {
        let btnVista1 = document.getElementById('btn1')
        btnVista1.onclick = this.irAVista1.bind(this)
        
        let btnVista2 = document.getElementById('btn2')
        btnVista2.onclick = this.irAVista2.bind(this)
        
        let btnVista3 = document.getElementById('btn3')
        btnVista3.onclick = this.irAVista3.bind(this)
    }

    limpiar(){
            const divs = document.getElementsByTagName('div');
            for (let i = 0; i < divs.length; i++) {
              divs[i].style.display = 'none';
            }   
	}
    
    irAVista1(){
        this.limpiar()
        this.vista1.load()
    }

    irAVista2(){
        this.limpiar()
        this.vista2.load()
    }

    irAVista3(){
        this.limpiar()
        this.vista3.load()
    }
}

// Crear una instancia de la clase Game
window.onload = new Game();

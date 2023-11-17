import { Vista } from "./vista.js"
/**
 * Clase que representa la vista del ranking, que extiende de la clase `Vista`.
 * @memberof VistaRanking
 * @extends Vista
 * @param {Object} controlador - El controlador asociado a la vista.
 * @param {HTMLElement} base - El elemento base de la vista.
 */
export class VistaRanking extends Vista {
    constructor(controlador, base) {
        super(controlador, base);

        /**
         * Realiza la navegación de vuelta a la vista principal.
         * @method
         */
        this.irMain = () => this.controlador.irAVista(this.controlador.vistaPrincipal);

        /**
         * Elemento de botón para volver atrás.
         * @type {HTMLButtonElement}
         */
        const btnBack = this.base.querySelectorAll('button')[1];

        // Asignar evento para ir a la vista principal al hacer clic en el botón de volver atrás
        btnBack.onclick = this.irMain;
    }
}

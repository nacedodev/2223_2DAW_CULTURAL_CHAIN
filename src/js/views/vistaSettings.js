import { Vista } from "./vista.js"
import { Rest } from "../services/rest.js"
/**
 * Clase que representa la vista de configuración, que extiende de la clase `Vista`.
 * @memberof VistaSettings
 * @extends Vista
 * @param {Object} controlador - El controlador asociado a la vista.
 * @param {HTMLElement} base - El elemento base de la vista.
 */
export class VistaSettings extends Vista {
    constructor(controlador, base) {
        super(controlador, base);

        /**
         * Realiza la navegación de vuelta a la vista principal.
         * @method
         */
        this.irMain = () => {
            this.controlador.irAVista(this.controlador.vistaPrincipal);
            this.textStatus.textContent = '';
            this.textRespuesta.textContent = '';
        };

        /**
         * Realiza una petición GET.
         * @method
         */
        this.llamarGET = () => {
            Rest.get("http://00.2daw.esvirgua.com/DWEC/peticionGet.php",{"param1":42,"param2":"Nacho"},this.resultadoGET);
        };

        /**
         * Muestra el resultado de la petición GET.
         * @method
         * @param {number} status - El código de estado de la respuesta.
         * @param {string} texto - El texto de respuesta.
         * @param {string} method - El método de la petición.
         */
        this.resultadoGET = (status, texto, method) => {
            this.textStatus.innerHTML = `● ${status}`;
            this.textRespuesta.innerHTML = `(<span style='color:#F5C505;'>${method}</span>) ${texto}`;
        };

        /**
         * Realiza una petición POST.
         * @method
         */
        this.llamarPOST = () => {
            const params = { param1: 1337, param2: "Nacho" };
            Rest.post("http://00.2daw.esvirgua.com/DWEC/peticionPost.php", params, this.resultadoPOST);
        };

        /**
         * Muestra el resultado de la petición POST.
         * @method
         * @param {number} status - El código de estado de la respuesta.
         * @param {string} texto - El texto de respuesta.
         * @param {string} method - El método de la petición.
         */
        this.resultadoPOST = (status, texto, method) => {
            this.textStatus.innerHTML = `● ${status}`;
            this.textRespuesta.innerHTML = `(<span style='color:#CD7F32;'>${method}</span>) ${texto.message}`;
        };

        const btnBack = this.base.querySelectorAll('button')[9];
        const btnGET = this.base.querySelectorAll('button')[7];
        const btnPOST = this.base.querySelectorAll('button')[8];
        
        /**
         * Elemento de texto para el estado de la petición.
         * @type {HTMLElement}
         */
        this.textStatus = document.getElementById('status');
        
        /**
         * Elemento de texto para la respuesta de la petición.
         * @type {HTMLElement}
         */
        this.textRespuesta = document.getElementById('respuesta');

        // Asignar evento para ir a la vista principal al hacer clic en el botón de volver atrás.
        btnBack.onclick = this.irMain;

        // Asignar evento para realizar la petición GET al hacer clic en el botón correspondiente.
        btnGET.onclick = this.llamarGET;

        // Asignar evento para realizar la petición POST al hacer clic en el botón correspondiente.
        btnPOST.onclick = this.llamarPOST;
    }
}
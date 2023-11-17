/**
 * @class
 * @classdesc Clase que representa la gestión general para mostrar y ocultar vistas.
 * @memberof Vista
 * @author Nacho - Antonio - Mario
 * @license MIT
 * @param {Object} controlador - El controlador asociado a la vista.
 * @param {HTMLElement} base - El elemento base de la vista.
 */
export class Vista {
    constructor(controlador, base) {
        /**
         * @member {Object}
         * @description El controlador asociado a la vista.
         */
        this.controlador = controlador;

        /**
         * @member {HTMLElement}
         * @description El elemento base de la vista.
         */
        this.base = base;
    }

    /**
     * Muestra u oculta la vista según el valor especificado.
     * @param {boolean} ver - Indica si se debe mostrar (`true`) u ocultar (`false`) la vista.
     */
    mostrar(ver) {
        if (ver) {
            this.base.style.display = 'block';
        } else {
            this.base.style.display = 'none';
        }
    }
}

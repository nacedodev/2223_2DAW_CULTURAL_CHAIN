import { Vista } from "./vista.js"

export class VistaSettings extends Vista{
    constructor(controlador,base){
        super(controlador,base)

        const btnBack = this.base.querySelectorAll('button')[6]
        btnBack.onclick = this.irMain
    }
    irMain = () => this.controlador.irAVista(this.controlador.vistaPrincipal)
}
import { Vista } from "./vista.js"

export class VistaRanking extends Vista{
    constructor(controlador,base){
        super(controlador,base)

        const btnBack = this.base.querySelectorAll('button')[1]
        btnBack.onclick = this.irMain
    }

    irMain = () => this.controlador.irAVista(this.controlador.vistaPrincipal)
}
import { Vista } from "./vista.js"

export class VistaPrincipal extends Vista{
    constructor(controlador , base){
        super(controlador,base)


        const btnRanking = this.base.querySelectorAll('button')[1]
        const btnSettings = this.base.querySelectorAll('button')[2]

        btnRanking.onclick = this.irRanking
        btnSettings.onclick = this.irSettings
    }

    irSettings = () => this.controlador.irAVista(this.controlador.vistaSettings)
    irRanking = () => this.controlador.irAVista(this.controlador.vistaRanking)
}
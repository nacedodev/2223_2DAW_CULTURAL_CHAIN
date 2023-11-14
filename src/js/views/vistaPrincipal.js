import { Vista } from "./vista.js"

export class VistaPrincipal extends Vista{
    constructor(controlador , base){
        super(controlador,base)

        const btnSettings = document.querySelectorAll('a')[2]
        btnSettings.onclick = this.irSettings
    }

    irSettings = () => this.controlador.irAVista(this.controlador.vistaSettings)
}
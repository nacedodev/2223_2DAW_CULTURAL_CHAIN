import { Vista } from "./vista.js"
import { Rest } from "../services/rest.js"

export class VistaSettings extends Vista{
    constructor(controlador,base){
        super(controlador,base)

        const btnBack = this.base.querySelectorAll('button')[9]
        const btnGET = this.base.querySelectorAll('button')[7]
        const btnPOST = this.base.querySelectorAll('button')[8]
        this.textStatus = document.getElementById('status')
        this.textRespuesta = document.getElementById('respuesta')

        btnBack.onclick = this.irMain
        btnGET.onclick = this.llamarGET
        btnPOST.onclick = this.llamarPOST
    }
    
    irMain = () => {
        this.controlador.irAVista(this.controlador.vistaPrincipal)
        this.textStatus.textContent = ''
        this.textRespuesta.textContent = ''
    }

    llamarGET = () => {
        Rest.get("http://localhost/server/peticionGet.php",{"param1":42,"param2":"Nacho"},this.resultadoGET)
    }

    resultadoGET = (status,texto,method) => {
        this.textStatus.innerHTML = `● ${status}`
        this.textRespuesta.innerHTML = `(<span style='color:#F5C505;'>${method}</span>) ${texto}`
    }

    llamarPOST = () => {
    const params = { param1: 1337, param2: "Nacho" };
        Rest.post("http://localhost/server/peticionPost.php", params, this.resultadoPOST);
    }

    resultadoPOST = (status, texto, method) => {
        this.textStatus.innerHTML = `● ${status}`
        this.textRespuesta.innerHTML = `(<span style='color:#CD7F32;'>${method}</span>) ${texto.message}`
    }
}
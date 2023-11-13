
export class Vista1{
    constructor(){
        const head = document.createElement('h2')
        head.textContent = 'Contenido de la vista1'
    
        const p = document.createElement('p')
        p.textContent = 'Este es un contenido de prueba para la vista 1'
    
        this.div = document.getElementById('vista1')
        this.div.appendChild(head)
        this.div.appendChild(p)
        this.div.style.display = 'none'

    }
    load(){
        this.div.style.display = 'block'
    }
}

export class Vista3{
    constructor(){
        const head = document.createElement('h2')
        head.textContent = 'Contenido de la vista3'
    
        const p = document.createElement('p')
        p.textContent = 'Este es un contenido de prueba para la vista 3'
    
        this.div = document.getElementById('vista3')
        this.div.appendChild(head)
        this.div.appendChild(p)
        this.div.style.display = 'none'

    }
    load(){
        this.div.style.display = 'block'
    }
}
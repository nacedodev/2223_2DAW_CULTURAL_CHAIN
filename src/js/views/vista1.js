
export class Vista1{
    constructor(){
        const head = document.createElement('h2')
        head.textContent = 'Contenido de la vista1'
    
        const p = document.createElement('p')
        p.textContent = 'Este es un contenido de prueba para la Vista 1. Puedes agregar cualquier tipo de información que desees aquí.'
    
        this.div = document.getElementById('vista1')
        this.div.appendChild(head)
        this.div.appendChild(p)
        this.div.style.display = 'none'
    }
    load(){
        this.div.style.display = 'block'
    }
}
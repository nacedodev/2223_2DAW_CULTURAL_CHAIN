
export class Vista2{
    constructor(){
        const head = document.createElement('h2')
        head.textContent = 'Contenido de la vista2'
    
        const p = document.createElement('p')
        p.textContent = '¡Hola desde la Vista 2! Este es un texto de muestra para llenar este div. Puedes personalizarlo según tus necesidades.'
    
        this.div = document.getElementById('vista2')
        this.div.appendChild(head)
        this.div.appendChild(p)
        this.div.style.display = 'none'
    }
    load(){
        this.div.style.display = 'block'
    }
}
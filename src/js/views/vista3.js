
export class Vista3{
    constructor(){
        const head = document.createElement('h2')
        head.textContent = 'Contenido de la vista3'
    
        const p = document.createElement('p')
        p.textContent = 'Contenido de prueba para la Vista 3. Puedes cambiar este texto y agregar elementos adicionales según lo que estás construyendo.'
    
        this.div = document.getElementById('vista3')
        this.div.appendChild(head)
        this.div.appendChild(p)
        this.div.style.display = 'none'
    }
    load(){
        this.div.style.display = 'block'
    }
}
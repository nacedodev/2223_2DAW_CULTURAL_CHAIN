
export class ModeloNames{
	constructor(){
		this.mapa = new Map()
	}

	guardarName(clave, valor){
		this.mapa.set(clave, valor)
	}

	verName(clave){
		return this.mapa.get(clave)
	}
}

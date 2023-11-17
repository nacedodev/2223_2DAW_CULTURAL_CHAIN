
export class ModeloConfig{
	constructor(){
		this.mapa = new Map()
	}

	guardarConfig(clave, valor){
		this.mapa.set(clave, valor)
	}

	verConfig(clave){
		return this.mapa.get(clave)
	}
}

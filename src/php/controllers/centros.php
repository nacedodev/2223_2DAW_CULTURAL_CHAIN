<?php
 
require_once '../models/centros.php';

class ControladorCentros {
   
    private $pagina;
    private $objCentros;

    public function __construct() {
        $this->pagina = '';
        $this->objCentros = new Centro();
    }

    public function listarCentros() {
            return $this->objCentros->listar();   
    }
    
    public function aniadirCentro($nombre,$localidad) {
        $this->objCentros->aniadir($nombre,$localidad);
    }

    public function borrarCentros($id) { 
        return $this->objCentros->borrar($id);
    }

    public function modificarCentros($id, $nombre, $localidad) { 
        return $this->objCentros->modificar($id, $nombre, $localidad);
    }
    
}
?>

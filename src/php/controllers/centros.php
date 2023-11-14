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
    
    public function aniadirCentro($id,$nombre,$localidad) {
        
        return $this->objCentros->aniadir($id,$nombre,$localidad);

    }
    
   
}
?>

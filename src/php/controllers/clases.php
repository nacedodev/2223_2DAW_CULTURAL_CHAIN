<?php
 
require_once '../models/clases.php';

class ControladorClases {
   
    private $pagina;
    private $objClases;
   
    public function __construct() {
        $this->pagina = '';
        $this->objClases = new Clase();
    }

    public function listarClases($centro_id) {

            return $this->objClases->listar($centro_id);   
    }
    
    public function aniadirClases($etapa,$clase,$centro_id) {
        $centro_id = isset($_GET['id']) ? $_GET['id'] : null;
         $this->objClases->aniadir($etapa,$clase,$centro_id);
         
    }

    public function borrarClases($id) { 
        return $this->objClases->borrar($id);
    }

    public function modificarClases($id, $etapa, $clase) { 
        return $this->objClases->modificar($id, $etapa, $clase);
    }
    
}
?>

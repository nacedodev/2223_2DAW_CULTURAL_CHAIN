<?php
 
require_once '../php/models/centros.php';

class ControladorCentros {
   
    
    public $objCentros;
    public $pagina;
    public $view;
    public function __construct() {
        $this->pagina = '';
        $this->objCentros = new Centro();
        $this->view='centros';
    }

    public function listarCentros() {
            return $this->objCentros->listar();   
    }
    
    public function aniadirCentro() {
        $this->view='aniadirCentros';
        if (isset($_POST['nombre']) && isset($_POST['localidad']) && !empty($_POST['nombre']) && !empty($_POST['localidad'])) {
            // Llamar a la función aniadir solo si las variables están presentes y no son vacías
             $this->objCentros->aniadir($_POST['nombre'], $_POST['localidad']);
             header("Location: admin.php?action=listarCentros&controller=Centros");
         }
    }
    public function borrarCentro() { 
      if (isset($_GET['id'])) {
         $this->objCentros->borrar($_GET['id']);
         header("Location: admin.php?action=listarCentros&controller=Centros");
    }
    }
    public function modificarCentro() { 
        $this->view='modificarCentros';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lógica para actualizar el centro en la base de datos
        $this->objCentros->modificar($_POST['id'], $_POST['nombre'], $_POST['localidad']);
        header("Location: admin.php?action=listarCentros&controller=Centros");
    }
       
    }
    
}
?>  

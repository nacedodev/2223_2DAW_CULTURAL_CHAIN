<?php

require_once './models/clases.php';

class ControladorClases{

    public $pagina;
    public $view;
    private $objClases;

    public function __construct() {
        $this->pagina = '';
        $this->view = '';
        $this->objClases = new Clase();
    }

    public function listarClases() {
        $this->view = 'clases';
        $this->pagina = 'Clases listadas';

        return $this->objClases->listar($_GET['centro_id']);
    }

    public function aniadirClases() {
        $this->view = 'aniadirClases';
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['etapa']) && isset($_POST['clase']) && !empty($_POST['etapa']) && !empty($_POST['clase'])) {
        $centro_id = $_GET['centro_id'];
          $this->objClases->aniadir($_POST['etapa'], $_POST['clase'], $centro_id);
        
       
            header('Location: index.php?action=listarClases&controller=Clases&centro_id=' . $centro_id);
         
        
    }
    }

    public function borrarClases() {
        if (isset($_GET['id'])) {
            $this->objClases->borrar($_GET['id']);
            $centro_id = $_GET['centro_id'];
            header("Location: index.php?action=listarClases&controller=Clases&centro_id=$centro_id");
       }
    }

    public function modificarClases() {

        $this->view='modificarClases';
            
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $centro_id = $_POST['centro_id'];
            // Lógica para actualizar el centro en la base de datos
            $this->objClases->modificar($_POST['id'], $_POST['etapa'], $_POST['clase']);
            header("Location: index.php?action=listarClases&controller=Clases&centro_id=$centro_id");
        }
           
        }
    }



?>

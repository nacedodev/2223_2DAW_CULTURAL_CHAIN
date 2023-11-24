<?php
require_once '../php/models/clases.php';
/**
 * Controlador para la gestión de clases.
 */
class ControladorClases{
 /** @var string Página actual del controlador. */
    public $pagina;
     /** @var string Página actual del controlador. */
    public $view;
     /** @var Clase Objeto para la manipulación de clases. */
    private $objClases;
 /**
     * Constructor del controlador de clases.
     */
    public function __construct() {
        $this->pagina = '';
        $this->objClases = new Clase();
    }
 /**
     * Lista las clases disponibles para un centro específico.
     *
     * @return array Datos de las clases.
     */
    public function listarClases() {
        $this->view = 'clases';
        $this->pagina = 'Clases listadas';

        return $this->objClases->listar($_GET['centro_id']);
    }
/**
     * Añade una nueva clase.
     */
    public function aniadirClases() {
        $this->view = 'aniadirClases';
        $centronombre=$_GET['centronombre'];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['etapa']) && isset($_POST['clase']) && !empty($_POST['etapa']) && !empty($_POST['clase'])) {
        $centro_id = $_GET['centro_id'];
          $this->objClases->aniadir($_POST['etapa'], $_POST['clase'], $centro_id);
        
       
          header("Location: index.php?action=listarClases&controller=Clases&centro_id=$centro_id&centronombre=$centronombre");
         
        
    }
    }
    /**
     * Borra una clase existente.
     */
    public function borrarClases() {
        $this->view='borradoClases';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_GET['id'])) {

                $this->objClases->borrar($_GET['id']);
                $centro_id = $_GET['centro_id'];
                $centronombre=$_GET['centronombre'];
                
               
                header("Location: index.php?action=listarClases&controller=Clases&centro_id=$centro_id&centronombre=$centronombre");
            }
        }
    }
    /**
     * Modifica una clase existente.
     */
    public function modificarClases() {

        $this->view='modificarClases';
        $centronombre=$_GET['centronombre'];
            
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $centro_id = $_POST['centro_id'];
            // Lógica para actualizar el centro en la base de datos
            $this->objClases->modificar($_POST['id'], $_POST['etapa'], $_POST['clase']);
            header("Location: index.php?action=listarClases&controller=Clases&centro_id=$centro_id&centronombre=$centronombre");
        }
           
        }
}
?>
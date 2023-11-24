<?php
require_once '../php/models/conflictos.php';
/**
 * Controlador para la gestión de clases.
 */
class ControladorConflictos{
 /** @var string Página actual del controlador. */
    public $pagina;
     /** @var string Página actual del controlador. */
    public $view;
     /** @var Clase Objeto para la manipulación de clases. */
    private $objConflictos;
 /**
     * Constructor del controlador de clases.
     */
    public function __construct() {
        $this->pagina = '';
        $this->view = '';
        $this->objConflictos = new Conflicto();
    }
 /**
     * Lista las clases disponibles para un centro específico.
     *
     * @return array Datos de las clases.
     */
    public function listarConflictos() {
        $this->view = 'conflictos';
        $this->pagina = 'Conflictos listadas';

        return $this->objConflictos->listar($_GET['id']);
    }
/**
     * Añade una nueva clase.
     */
    public function aniadirConflictos() {
        $this->view = 'aniadirConflictos';
        $nombrepais=$_GET['nombrepais'];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombreconficto']) && isset($_POST['ejeX']) && isset($_POST['ejeY']) && isset($_FILES['imagen']['tmp_name']) ) {
            $nivel_id = $_GET['nivel_id'];
            $imagenTmp = $_FILES['imagen']['tmp_name'];
            $imagenBinaria = file_get_contents($imagenTmp);

            $this->objConflictos->aniadir($_POST['nombreconflicto'],$_POST['ejeX'],$_POST['ejeY'],$imagenBinaria,$nivel_id);
           header("Location: index.php?action=listarConflictos&controller=Conflictos&nivel_id=$nivel_id&nombrepais=$nombrepais"); 
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
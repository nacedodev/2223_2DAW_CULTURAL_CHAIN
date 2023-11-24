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
        $nombrepais = $_GET['nombrepais'];
        $nivel_id = $_GET['id'] ?? null;
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
            isset($_POST['nombreConficto']) &&
            isset($_POST['ejeX']) &&
            isset($_POST['ejeY'])
        ) {
            // Resto del código para añadir el conflicto
            $this->objConflictos->aniadir(
                $_POST['nombreConficto'],
                $_POST['ejeX'],
                $_POST['ejeY'],
                $_POST['estadoconflicto'],
                $nivel_id
            );
            // Redirección después de añadir el conflicto
            header("Location: index.php?action=listarConflictos&controller=Conflictos&id=$nivel_id&nombrepais=$nombrepais");
            exit();  // Añadí esta línea para evitar ejecución adicional después de la redirección
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
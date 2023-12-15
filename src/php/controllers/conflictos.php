<?php
require_once '../php/models/mConflictos.php';
/**
 * Controlador para la gestión de clases.
 */
class Conflictos{
 /** @var string Página actual del controlador. */
    public $pagina;
     /** @var string Página actual del controlador. */
    public $view;
     /** @var mClase Objeto para la manipulación de clases. */
    private $objConflictos;
 /**
     * Constructor del controlador de clases.
     */
    public function __construct() {
        $this->pagina = '';
        $this->objConflictos = new mConflicto();
    }
 /**
     * Lista las clases disponibles para un centro específico.
     *
     * @return array Datos de las clases.
     */
    public function listarConflictos() {
        $this->view = 'conflictos';
        $this->pagina = 'Conflictos listadas';

        return $this->objConflictos->listar($_GET['nivel_id']);
    }
/**
     * Añade una nueva clase.
     */
    public function aniadirConflictos() {
        $this->view = 'aniadirConflictos';
        $nombrepais = $_GET['nombrepais'];
        $nivel_id = $_GET['nivel_id'] ?? null;
    
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
            header("Location: index.php?action=listarConflictos&controller=conflictos&nivel_id=$nivel_id&nombrepais=$nombrepais");
            exit();  // Añadí esta línea para evitar ejecución adicional después de la redirección
        }
    }
    
    /**
     * Borra una clase existente.
     */
    public function borrarConflictos() {
        $this->view='borradoConflictos';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_GET['id'])) {

                $this->objConflictos->borrar($_GET['id']);
                $nivel_id = $_GET['nivel_id'];
                $nombrepais=$_GET['nombrepais'];
                $id=$_GET['id'];
                
               
                header("Location: index.php?action=listarConflictos&controller=conflictos&nivel_id=$nivel_id&nombreconflicto=$nombreconflicto&id=$id&nombrepais=$nombrepais");
            }
        }
    }
    /**
     * Modifica una clase existente.
     */
    public function modificarConflictos() {

        $this->view='modificarConflictos';
        $nombrepais=$_GET['nombrepais'];
            
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nivel_id = $_GET['nivel_id'];
            $id=$_POST['id'];
            // Lógica para actualizar el centro en la base de datos
            $this->objConflictos->modificar($_POST['id'], $_POST['nombreconflicto'], $_POST['estadoconflicto'], $_POST['ejeX'], $_POST['ejeY']);
            header("Location: index.php?action=listarConflictos&controller=conflictos&nivel_id=$nivel_id&id=$id&nombrepais=$nombrepais");
        }
           
        }
}
?>
<?php
 
require_once '../php/models/niveles.php';
/**
 * Controlador para la gestión de niveles.
 */
class ControladorNiveles {
   
    /** @var Nivel Objeto para la manipulación de niveles. */
    public $objNiveles;
     /** @var string Página actual del controlador. */
    public $pagina;
    /** @var string Vista por defecto del controlador. */
    public $view;
    /**
     * Constructor del controlador de centros.
     */
    public function __construct() {
        $this->pagina = '';
        $this->objNiveles = new Nivel();
        $this->view='niveles';
    }
/**
     * Lista los centros disponibles.
     *
     * @return array Datos de los centros.
     */
    public function listarNiveles() {
            return $this->objNiveles->listar();   
    }
    /**
     * Añade un nuevo centro.
     */
    public function aniadirNivel() {
        $this->view='aniadirNiveles';
        if (isset($_POST['nombrepais'])) {
            // Llamar a la función aniadir solo si las variables están presentes y no son vacías
             $this->objNiveles->aniadir($_POST['nombrepais']);
             header("Location: index.php?action=listarNiveles&controller=Niveles");
         }
    }
     /**
     * Borra un centro existente.
     */
    public function borrarNivel() { 
        $this->view='borradoNiveles';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             if (isset($_GET['id'])) {
            $this->objNiveles->borrar($_GET['id']);
            header("Location: index.php?action=listarNiveles&controller=Niveles");
            }
        }
    }
    /**
     * Modifica un centro existente.
     */
    public function modificarNivel() { 
        $this->view='modificarNiveles';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lógica para actualizar el centro en la base de datos
        $this->objNiveles->modificar($_POST['id'], $_POST['nombrepais']);
        header("Location: index.php?action=listarNiveles&controller=Niveles");
    }
       
    }
    
}
<?php
require_once '../php/models/administracion.php';
/**
 * Controlador para la gestión de centros.
 */
class ControladorAdministracion {

    /** @var Administracion Objeto para la manipulación de centros. */
    public $objAdministracion;
     /** @var string Página actual del controlador. */
    public $pagina;
    /** @var string Vista por defecto del controlador. */
    public $view;
    /**
     * Constructor del controlador de centros.
     */
    public function __construct() {
        $this->pagina = '';
        $this->objAdministracion = new Administracion(HOST,USER,PASSWORD,DATABASE, CHARSET);
    }
    public function mostrarPanel(){
         $this->view='admin';
    }

    public function verificarWeb(){
        $this->view = 'admin';
        $this->objAdministracion->verificarTablas();
        
        // Obtener los mensajes
        $estado = $this->objAdministracion->estado;
        $estado_reflexiones = $this->objAdministracion->estado_reflexiones;
        $mensajes = $this->objAdministracion->mensajes;
    
        // Enviar del controlador a la vista los mensajes de la verificación
        header("Location: index.php?controller=administracion&action=mostrarPanel&estado=$estado&reflexiones=$estado_reflexiones&mensajes=$mensajes");
        exit();
    }
    
}

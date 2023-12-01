<?php
require_once '../php/models/administracion.php';
/**
 * Controlador para la gestión de centros.
 */
class ControladorAdministracion {

    /** @var Centro Objeto para la manipulación de centros. */
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
        $this->view='admin';
        $this->objAdministracion->verificarTablas();
    }
}

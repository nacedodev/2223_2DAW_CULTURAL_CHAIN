<?php
/**
 * Controlador para la gestión de centros.
 */
class ControladorAdministracion {

    /** @var Centro Objeto para la manipulación de centros. */
    public $objCentros;
     /** @var string Página actual del controlador. */
    public $pagina;
    /** @var string Vista por defecto del controlador. */
    public $view;
    /**
     * Constructor del controlador de centros.
     */
    public function __construct() {
        $this->pagina = '';
    }
    public function mostrarPanel(){
         $this->view='admin';
    }
}

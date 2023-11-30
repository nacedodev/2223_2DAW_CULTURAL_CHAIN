<?php

require_once '../php/models/reflexiones.php';
/**
 * Controlador para la gestión de reflexiones.
 */
class ControladorReflexiones {

    /** @var Reflexion Objeto para la manipulación de reflexiones. */
    public $objReflexiones;
    /** @var string Vista por defecto del controlador. */
    public $view;
    /**
     * Constructor del controlador de centros.
     */
    public function __construct() {
        $this->objReflexiones = new Reflexion(HOST,USER,PASSWORD,DATABASE, CHARSET);
    }
/**
     * Lista las reflexiones añadidas.
     *
     * @return array Datos de los las reflexiones.
     */

    public function gestionarReflexiones()
    {
        $this->view = 'gestionreflexiones';
        $nivel_id = $_GET['nivel_id'];

        // Si se envía el formulario para añadir nuevas reflexiones
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['titulos']) && !empty($_POST['contenidos'])) {
            $titulos = $_POST['titulos'];
            $contenidos = $_POST['contenidos'];

            // Primero, borramos las reflexiones existentes asociadas a ese nivel
            $this->objReflexiones->borrar($nivel_id);

            // Luego, añadimos las nuevas reflexiones
            $this->objReflexiones->aniadir($titulos, $contenidos, $nivel_id);
        }

        // Obtener la lista de reflexiones actualizada
        $reflexiones = $this->objReflexiones->listar($nivel_id);

        return $reflexiones;
    }


    public function borrarReflexiones()
    {
        $this->view = 'reflexiones';
        $this->objReflexiones->borrar($_GET['nivel_id']);
            }
}

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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['titulos']) && isset($_POST['contenidos'])) {
            $titulos = $_POST['titulos'];
            $contenidos = $_POST['contenidos'];

            // Filtrar los arrays para eliminar elementos vacíos
            $titulos = array_filter($titulos);
            $contenidos = array_filter($contenidos);

            if (!empty($titulos) && !empty($contenidos)) {
                // Si hay elementos después de la filtración, se añaden las nuevas reflexiones
                $this->objReflexiones->borrar($nivel_id);
                $this->objReflexiones->aniadir($titulos, $contenidos, $nivel_id);
            } else {
                // Si ambos arrays están vacíos, se borran todas las reflexiones asociadas al nivel
                $this->objReflexiones->borrar($nivel_id);
            }
        } else {
            // Si no se envían los arrays 'titulos' y 'contenidos', se borran todas las reflexiones asociadas al nivel
            $this->objReflexiones->borrar($nivel_id);
        }
    }

    // Obtener la lista de reflexiones actualizada
    $reflexiones = $this->objReflexiones->listar($nivel_id);

    return $reflexiones;
}

}

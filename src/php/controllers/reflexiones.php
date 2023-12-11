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
    /** @var array variable que almacena una copia de seguridad de las reflexiones asociaas a una BD , en caso de error al añadir. */
    private $backupReflexiones = array();
    /**
     * Constructor del controlador de reflexiones.
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
    $nombrepais = $_GET['nombrepais'];

    // Si se envía el formulario para añadir nuevas reflexiones
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['titulos']) && isset($_POST['contenidos'])) {
            $titulos = $_POST['titulos'];
            $contenidos = $_POST['contenidos'];

            // Si algun valor de los titulos o del contenido está vacío , mostramos un mensaje de error y salímos de la funcion
            if (in_array('', $contenidos, true) || in_array('', $titulos, true)) {
                $mensaje = "Título o contenido vacío";
                header("Location: index.php?controller=reflexiones&action=gestionarReflexiones&nivel_id=$nivel_id&nombrepais=$nombrepais&&mensaje=$mensaje");
                exit;
            }
            
            // Filtrar los arrays para eliminar elementos vacíos
            $titulos = array_filter($titulos);
            $contenidos = array_filter($contenidos);

            // Si hay elementos después de la filtración, se añaden las nuevas reflexiones
            if (!empty($titulos) && !empty($contenidos)) {
                // Almaceno un backup del estado actual de las reflexiones , para que en caso de error al añadir , no se pierda todo por el borrado previo.
                $this->backupReflexiones = $this->obtenerReflexiones($nivel_id);
                
                $this->objReflexiones->borrar($nivel_id);
                $this->objReflexiones->aniadir($titulos, $contenidos, $nivel_id);
                if(isset($this->objReflexiones->mensaje)){
                    //Si recibimos un mensaje de error , restauramos las reflexiones a como estaban antes del borrado , para no perder el contenido.
                    $this->restaurarReflexiones($nivel_id);
                    // si nos llega algún mensaje de error desde el modelo , lo mostramos
                    $mensaje = $this->objReflexiones->mensaje;
                    header("Location: index.php?controller=reflexiones&action=gestionarReflexiones&nivel_id=$nivel_id&nombrepais=$nombrepais&&mensaje=$mensaje");
                    exit;
                }
            } else {
                // Si ambos arrays están vacíos, se borran todas las reflexiones asociadas al nivel
                $this->objReflexiones->borrar($nivel_id);
                // Si nos llega algún mensaje de error desde el modelo , lo mostramos
                if(isset($this->objReflexiones->mensaje)){
                    $mensaje = $this->objReflexiones->mensaje;
                    header("Location: index.php?controller=reflexiones&action=gestionarReflexiones&nivel_id=$nivel_id&nombrepais=$nombrepais&&mensaje=$mensaje");
                    exit;
                }
            }
        } else {
            // Si no se envían los arrays 'titulos' y 'contenidos', se borran todas las reflexiones asociadas al nivel
            $this->objReflexiones->borrar($nivel_id);
            // Si nos llega algún mensaje de error desde el modelo , lo mostramos
            if(isset($this->objReflexiones->mensaje)){
                $mensaje = $this->objReflexiones->mensaje;
                header("Location: index.php?controller=reflexiones&action=gestionarReflexiones&nivel_id=$nivel_id&nombrepais=$nombrepais&&mensaje=$mensaje");
                exit;
            }
        }
    }

    // Obtener la lista de reflexiones actualizada
    $reflexiones = $this->objReflexiones->listar($nivel_id);

    return $reflexiones;
    }

// Método para obtener las reflexiones actuales antes de borrarlas
    public function obtenerReflexiones($nivel_id) {
        // Obtener las reflexiones actuales
        $reflexiones = $this->objReflexiones->listar($nivel_id);
        $this->backupReflexiones = $reflexiones;
        return $this->backupReflexiones;
    }

    // Método para restaurar las reflexiones previas al borrado , por si el añadir sale mal
    public function restaurarReflexiones($nivel_id) {
        if (isset($this->backupReflexiones)) {
            // Restaurar las reflexiones guardadas en la copia de seguridad
            $titulos = $this->backupReflexiones['titulo'];
            $contenidos = $this->backupReflexiones['contenido'];
            
            // Verificar si las claves 'titulos' y 'contenidos' existen en las reflexiones guardadas
            if (isset($titulos) && isset($contenidos)) {
                $this->objReflexiones->borrar($nivel_id); // Borrar las reflexiones actuales
                $this->objReflexiones->aniadir($titulos, $contenidos, $nivel_id); // Añadir las reflexiones guardadas
            }
        }
    }


}

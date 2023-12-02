<?php

require_once '../php/models/personajes.php';
/**
 * Controlador para la gestión de niveles.
 */
class ControladorPersonajes {

    /** @var Nivel Objeto para la manipulación de niveles. */
    public $objPersonajes;
     /** @var string Página actual del controlador. */
    public $pagina;
    /** @var string Vista por defecto del controlador. */
    public $view;
    /**
     * Constructor del controlador de centros.
     */
    public function __construct() {
        $this->objPersonajes = new Personaje(HOST,USER,PASSWORD,DATABASE, CHARSET);
    }
/**
     * Lista los centros disponibles.
     *
     * @return array Datos de los centros.
     */
     

     public function listarPersonajes() {
        $this->view = 'personajesv2';
        return $this->objPersonajes->listar();
    }

    public function aniadirPersonajes() {
        $this->view = 'aniadirPersonajes';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                isset($_POST['nombre']) &&
                isset($_FILES['imagenPersonaje']['tmp_name']) &&
                isset($_POST['pais'])
            ) {
                $nombre = $_POST['nombre'];
                $pais = $_POST['pais'];
                $imagenTmp = $_FILES['imagenPersonaje']['tmp_name'];
    
                // Limitar el tamaño máximo a 1MB
                $maxFileSize = 0.5 * 1024 * 1024; // 5 MB en bytes
    
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif','webp']; // Extensiones permitidas
    
                $fileExtension = strtolower(pathinfo($_FILES['imagenPersonaje']['name'], PATHINFO_EXTENSION));
    
                if (
                    $_FILES['imagenPersonaje']['size'] <= $maxFileSize &&
                    in_array($fileExtension, $allowedExtensions)
                ) {
                    $imagenPersonaje = file_get_contents($imagenTmp);
                    $this->objPersonajes->aniadir($nombre, $pais, $imagenPersonaje);
                    header("Location: index.php?action=listarPersonajes&controller=personajes");
                } else {
                    // Mostrar un mensaje de error si el archivo excede el tamaño permitido o tiene una extensión no permitida
                    echo "El archivo no es una imagen válida o excede el tamaño permitido";
                }
            }
        }
    }
    

    public function borrarPersonaje() {
        $this->view='borradoPersonajes';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             if (isset($_GET['id'])) {
            $this->objPersonajes->borrar($_GET['id']);
            header("Location: index.php?action=listarPersonajes&controller=personajes&");
            }
        }
    }

    public function modificarPersonajes() {
        $this->view='modificarPersonajes';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lógica para actualizar el centro en la base de datos
        if ($_FILES['imagenPersonaje']['error'] !== UPLOAD_ERR_NO_FILE) {
            // Se ha seleccionado un archivo
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $pais = $_POST['pais'];
            $imagenTmp = $_FILES['imagenPersonaje']['tmp_name'];
            $imagenPersonaje = file_get_contents($imagenTmp);
        } else
        $imagenPersonaje = 0;
        $this->objPersonajes->modificar($id,$nombre,$pais,$imagenPersonaje);

        header("Location: index.php?action=listarPersonajes&controller=personajes");
    }

    }

}

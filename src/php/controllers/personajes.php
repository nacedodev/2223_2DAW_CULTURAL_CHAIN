<?php

require_once '../php/models/personajes.php';
/**
 * Controlador para la gestión de personajes.
 */
class ControladorPersonajes {

    /** @var Personaje Objeto para la manipulación de personajes. */
    public $objPersonajes;
     /** @var string Página actual del controlador. */
    public $pagina;
    /** @var string Vista por defecto del controlador. */
    public $view;
    /**
     * Constructor del controlador de personajes.
     */
    public function __construct() {
        $this->objPersonajes = new Personaje(HOST,USER,PASSWORD,DATABASE, CHARSET);
    }

    public function gestionarPersonajes()
    {
        $this->view = 'gestionpersonajes';
        
        // Definir el tamaño máximo en bytes (por ejemplo, 2MB = 2 * 1024 * 1024 bytes)
        $tamanioMaximo = 0.5 * 1024 * 1024;
        $extensionesValidas = array("jpg", "jpeg", "png", "gif", "webp"); // Extensiones permitidas
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['imagenPersonajes']) && isset($_POST['nombres'])) {
                $imagenes = $_FILES['imagenPersonajes'];
                $nombres = $_POST['nombres'];
                $errores = true;
    
                $imagenes = array_filter($imagenes);
                $nombres = array_filter($nombres);
    
                if (!empty($imagenes) && !empty($nombres)) {
                    foreach ($imagenes['size'] as $indice => $tamanio) {
                        $nombreArchivo = $imagenes['name'][$indice];
                        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION)); // Obtener la extensión del archivo
    
                        // Verificar si la extensión es válida y el tamaño no excede el límite
                        if (in_array($extension, $extensionesValidas) && $tamanio <= $tamanioMaximo) {
                            $errores = false;
                        } elseif (!in_array($extension, $extensionesValidas) && $tamanio > $tamanioMaximo) {
                            // Mensaje para archivo que no cumple ni tamaño ni extensión
                            $mensaje = "La imagen $nombreArchivo no es válida , excede el tamaño permitido y no tiene una extensión válida ( ". implode(", ", $extensionesValidas).").";
                            header("Location: index.php?controller=personajes&action=gestionarPersonajes&mensaje=$mensaje");
                            exit;
                        } elseif (!in_array($extension, $extensionesValidas)) {
                            // Mensaje de error para extensión no válida
                            $mensaje = "La imagen $nombreArchivo tiene una extensión no válida. Asegúrate de subir archivos de imagen con extensiones: " . implode(", ", $extensionesValidas);
                            header("Location: index.php?controller=personajes&action=gestionarPersonajes&mensaje=$mensaje");
                            exit;
                        } elseif ($tamanio > $tamanioMaximo) {
                            // Mensaje de error para tamaño excedido
                            $mensaje = "La imagen $nombreArchivo excede el tamaño permitido.";
                            header("Location: index.php?controller=personajes&action=gestionarPersonajes&mensaje=$mensaje");
                            exit;
                        }
                    }
                    if($errores == false){
                        $this->objPersonajes->aniadir($imagenes,$nombres);
                    }
                }
            }
        }
    
        $personajes = $this->objPersonajes->listar();
    
        return $personajes;
    }
    
        
    public function borrarPersonajes()
    {
        $this->view = 'gestionpersonajes';
        
        if (isset($_GET['ids'])) {
            $idsString = $_GET['ids']; // Obtener los IDs como una cadena desde la URL
            $ids = explode(',', $idsString);
            // Llamar al método borrar del modelo y pasarle la cadena de IDs
            $this->objPersonajes->borrar($ids);
    
            header("Location: index.php?action=gestionarPersonajes&controller=personajes");
        }
    }
    

        public function modificarPersonajes()
        {
            $this->view = 'modificarPersonajes';
        
            // Definir el tamaño máximo en bytes (por ejemplo, 2MB = 2 * 1024 * 1024 bytes)
            $tamanioMaximo = 0.5 * 1024 * 1024; // Cambiar este valor según tu necesidad
            $extensionesValidas = array("jpg", "jpeg", "png", "gif","webp"); // Extensiones permitidas
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Lógica para actualizar el personaje en la base de datos
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                
                if ($_FILES['imagenPersonaje']['error'] !== UPLOAD_ERR_NO_FILE) {
                    // Se ha seleccionado un archivo
                    $imagenTmp = $_FILES['imagenPersonaje']['tmp_name'];
                    $tamanioImagen = $_FILES['imagenPersonaje']['size'];
                    $extensionImagen = strtolower(pathinfo($_FILES['imagenPersonaje']['name'], PATHINFO_EXTENSION));
        
                    // Verificar si la extensión es válida y el tamaño no excede el límite
                    if (in_array($extensionImagen, $extensionesValidas) && $tamanioImagen <= $tamanioMaximo) {
                        $imagenPersonaje = file_get_contents($imagenTmp);
                        $this->objPersonajes->modificar($id, $nombre, $imagenPersonaje);
                        header("Location: index.php?action=gestionarPersonajes&controller=personajes");
                    } elseif (!in_array($extensionImagen, $extensionesValidas) && $tamanioImagen > $tamanioMaximo) {
                        // Mensaje para imagen que no cumple ni tamaño ni extensión
                        $mensaje = "La imagen ".$_FILES['imagenPersonaje']['name']." no es válida , excede el tamaño permitido y no tiene una extensión válida ( ". implode(", ", $extensionesValidas).").";
                        header("Location: index.php?action=modificarPersonajes&controller=personajes&id=$id&nombre=$nombre&mensaje=$mensaje");
                        exit();


                    } elseif (!in_array($extensionImagen, $extensionesValidas)) {
                        // Mensaje de error para extensión no válida
                        $mensaje = "La imagen seleccionada tiene una extensión no válida. Asegúrate de subir archivos de imagen con extensiones: " . implode(", ", $extensionesValidas);
                    } elseif ($tamanioImagen > $tamanioMaximo) {
                        // Mensaje de error para tamaño excedido
                        $mensaje = "La imagen seleccionada excede el tamaño permitido.";
                    }
                } else {
                    // No se ha seleccionado una nueva imagen, modificar solo el nombre
                    $imagenPersonaje = 0;
                    $this->objPersonajes->modificar($id, $nombre, $imagenPersonaje);
                    header("Location: index.php?action=gestionarPersonajes&controller=personajes");
                }
            }
        }
        

    }


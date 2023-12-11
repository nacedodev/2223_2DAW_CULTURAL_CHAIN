<?php

/**
 * Clase para la manipulación de datos relacionados con los niveles.
 */
class Nivel {
    /** @var mysqli Conexión a la base de datos. */
  private $conexion;

    /**
     * Constructor de la clase Nivel.
     * Inicia la conexión a la base de datos.
     */
    public function __construct() { 
       
        $this->conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);

        // Verificar la conexión
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }

        // Establecer el conjunto de caracteres utf8mb4
        if (!$this->conexion->set_charset("utf8mb4")) {
            printf("Error al establecer el conjunto de caracteres utf8mb4: %s\n", $this->conexion->error);
            exit();
        }
    }
    /**
     * Añade un nuevo nivel a la base de datos.
     *
     * @param string $nombrepais Nombre del país asociado al nivel.
     * @param string $imagen     Imagen del nivel.
     */
    public function aniadir($nombrepais, $imagen) {

        $imagen = $this->conexion->real_escape_string($imagen);
    
        $query = "INSERT INTO Nivel (nombrepais, imagen) VALUES ('$nombrepais','$imagen')";
        try {
            $resultado = $this->conexion->query($query);
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                echo 'nombre duplicado';
            }
        }
    }
    /**
     * Modifica un nivel existente en la base de datos.
     *
     * @param int    $id         ID del nivel a modificar.
     * @param string $nombrepais Nuevo nombre del país asociado al nivel.
     * @param string $imagen     Nueva imagen del nivel.
     * @return bool              True si la modificación fue exitosa, false de lo contrario.
     */
    public function modificar($id,$nombrepais,$imagen) {
        if(!$imagen==0){
            $imagen = $this->conexion->real_escape_string($imagen);
            $query = "UPDATE Nivel SET nombrepais = '$nombrepais',imagen = '$imagen' WHERE id = '$id'";
        }else
        $query = "UPDATE Nivel SET nombrepais = '$nombrepais' WHERE id = '$id'";
        $resultado = $this->conexion->query($query);
        return $resultado;
    }
    /**
     * Borra un nivel de la base de datos.
     *
     * @param int $id ID del nivel a borrar.
     */
    public function borrar($id) {
        try {
            $query = "DELETE FROM Nivel WHERE id = '$id'";
            
            $resultado = $this->conexion->query($query); 
            if ($resultado === false) {
               
               echo 'Error al eliminar el nivel';
            }
            //código de error de la existencia en otras tablas
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1451) {
                
                echo 'nivel tiene valores en otras tablas';
            } 
        }
    }
     /**
     * Lista todos los niveles registrados en la base de datos.
     *
     * @return array Arreglo asociativo con los datos de los niveles.
     */
    public function listar() {
        $query = 'SELECT * FROM Nivel';
        $resultado = $this->conexion->query($query); 
        $niveles = [];
    
        if ($resultado === false) {
            // La consulta SELECT falló
            echo 'Error al consultar la base de datos';
        } else {
            if ($resultado->num_rows === 0) {
                // No se encontraron filas en la tabla "Nivel"
                echo '<p id="error">No hay Niveles registrados </p>';
            } else {
                while ($row = $resultado->fetch_assoc()) {
                    $niveles[] = $row;
                }
            }
        }
        return $niveles;
    }
    
    /**
     * Obtiene la imagen de un nivel por su ID.
     *
     * @param int $id ID del nivel.
     * @return string|null Imagen en formato base64 o null si no se encuentra.
     */
    public function obtenerImagenPorId($id) {
        $id = $this->conexion->real_escape_string($id);
        
        $query = "SELECT imagen FROM Nivel WHERE id = '$id'";
        $resultado = $this->conexion->query($query);
    
        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return base64_encode($fila['imagen']); // Codifica la imagen en base64
        } else {
            return null; // o maneja el error de alguna manera
        }
    }

    public function tieneReflexiones($nivelId) {
        $nivelId = $this->conexion->real_escape_string($nivelId);
    
        $query = "SELECT COUNT(*) AS total_reflexiones FROM Reflexion WHERE nivel_id = '$nivelId'";
        $resultado = $this->conexion->query($query);
    
        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return $fila['total_reflexiones'] > 0; // Devuelve true si hay reflexiones asociadas
        } else {
            return false; // o maneja el error de alguna manera
        }
    }
}
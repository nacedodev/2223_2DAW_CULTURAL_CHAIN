<?php

/**
 * Clase para la manipulación de datos relacionados con los centros.
 */
class Centro {
    /** @var mysqli Conexión a la base de datos. */
  private $conexion;

    /**
     * Constructor de la clase Centro.
     * Inicia la conexión a la base de datos.
     */
    public function __construct() { 
       
        $this->conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);

    }
 /**
     * Añade un nuevo centro a la base de datos.
     *
     * @param string $nombre     Nombre del centro.
     * @param string $localidad  Localidad del centro.
     */
    public function aniadir($nombre, $localidad) {
        $query = "INSERT INTO Centro (nombre, localidad) VALUES ('$nombre', '$localidad')";

    
        try {
            $resultado = $this->conexion->query($query);
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                // Código 1062 indica una violación de clave única
                echo 'nombre duplicado';
            } 
        }
    }
 /**
     * Modifica un centro existente en la base de datos.
     *
     * @param int    $id         ID del centro a modificar.
     * @param string $nombre     Nuevo nombre del centro.
     * @param string $localidad  Nueva localidad del centro.
     * @return bool              True si la modificación fue exitosa, false de lo contrario.
     */
    public function modificar($id,$nombre,$localidad) {
        $query = "UPDATE Centro SET nombre = '$nombre', localidad = '$localidad' WHERE id = '$id'";
        $resultado = $this->conexion->query($query);
        return $resultado;
    }
 /**
     * Borra un centro de la base de datos.
     *
     * @param int $id ID del centro a borrar.
     */
    public function borrar($id) {
        try {
            $query = "DELETE FROM Centro WHERE id = '$id'";
            
            $resultado = $this->conexion->query($query); 
            if ($resultado === false) {
               
               echo 'Error al eliminar el centro';
            }
            //código de error de la existencia en otras tablas
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1451) {
                
                echo 'centros tiene valores en otras tablas';
            } 
        }
    }
     /**
     * Lista todos los centros registrados en la base de datos.
     *
     * @return array Arreglo asociativo con los datos de los centros.
     */
    public function listar() {
        $query= 'SELECT * FROM Centro';
        $resultado = $this->conexion->query($query); 
        $centros = [];

        if ($resultado === false) {
            // La consulta SELECT falló
            echo 'Error al consultar la base de datos';
        } else {
            if ($resultado->num_rows === 0) {
                // No se encontraron filas en la tabla "nombre"
                echo '<p style="color:#6F7789;position:absolute;font-size:30px;left:490px;top:370px;z-index:99">No hay centros registrados </p>';
            } else {
                foreach ($resultado as $row) {
                    $centros[] = $row;
                }
            }
        }
        return $centros;
    }
}
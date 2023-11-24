<?php

/**
 * Clase para la manipulación de datos relacionados con los centros.
 */
class Nivel {
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
    public function aniadir($nombrepais, $imagen) {

        $imagen = $this->conexion->real_escape_string($imagen);
    
        $query = "INSERT INTO Nivel (nombrepais, imagen) VALUES ('$nombrepais','$imagen')";
        echo $query;
        try {
            $resultado = $this->conexion->query($query);
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
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
     * Borra un centro de la base de datos.
     *
     * @param int $id ID del centro a borrar.
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
     * Lista todos los centros registrados en la base de datos.
     *
     * @return array Arreglo asociativo con los datos de los centros.
     */
    public function listar() {
        $query= 'SELECT * FROM Nivel';
        $resultado = $this->conexion->query($query); 
        $niveles = [];

        if ($resultado === false) {
            // La consulta SELECT falló
            echo 'Error al consultar la base de datos';
        } else {
            if ($resultado->num_rows === 0) {
                // No se encontraron filas en la tabla "nombre"
                echo '<p style="color:#6F7789;position:absolute;font-size:30px;left:490px;top:370px;z-index:99">No hay Niveles registrados </p>';
            } else {
                foreach ($resultado as $row) {
                    $niveles[] = $row;
                }
            }
        }
        return $niveles;
    }
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
}
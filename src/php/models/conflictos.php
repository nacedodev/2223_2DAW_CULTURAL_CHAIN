<?php
class Conflicto {
 /** @var mysqli Conexión a la base de datos. */
    private $conexion;
   
     /**
     * Constructor de la clase Clase.
     * Inicia la conexión a la base de datos.
     */
    public function __construct() { 
       
        $this->conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);


    }
 /**
     * Añade una nueva clase a la base de datos.
     *
     * @param string $etapa      Etapa de la clase.
     * @param string $clase      Nombre de la clase.
     * @param int    $centro_id  ID del centro asociado a la clase.
     */
    public function aniadir($nombreConflicto, $posX,$posY,$estado,$imagen,$nivel_id) {
        $imagen = $this->conexion->real_escape_string($imagen);
        $query = "INSERT INTO Conflicto (nombreconflicto, posx,posy,estadoconflicto,nivel_id) VALUES ('$nombreConflicto', $posx, $posy,$estado,$nivel_id)";
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
     * Modifica una clase existente en la base de datos.
     *
     * @param int    $id     ID de la clase a modificar.
     * @param string $etapa  Nueva etapa de la clase.
     * @param string $clase  Nuevo nombre de la clase.
     * @return bool          True si la modificación fue exitosa, false de lo contrario.
     */
    public function modificar($id,$etapa,$clase) {
        $query = "UPDATE Clase SET etapa = '$etapa', clase = '$clase' WHERE id = '$id'";
        $resultado = $this->conexion->query($query);
        return $resultado;
    }
/**
     * Borra una clase de la base de datos.
     *
     * @param int $id ID de la clase a borrar.
     */
    public function borrar($id) {
        try {
            $query = "DELETE FROM Clase WHERE id = '$id'";
            $resultado = $this->conexion->query($query);
    
            if ($resultado === false) {
               echo 'Error al eliminar la clase ';
            }
            //código de error de la existencia en otras tablas
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1451) {
                
                echo 'clase tiene valores en otras tablas';
            } 
        }
    }
    /**
     * Lista todas las clases asociadas a un centro específico.
     *
     * @param int $centro_id ID del centro asociado a las clases.
     * @return array Arreglo asociativo con los datos de las clases.
     */
    public function listar($id) {
        $query = "SELECT * FROM Conflicto WHERE nivel_id = '$id'";

        $resultado = $this->conexion->query($query); 
        $conflictos = [];

        if ($resultado === false) {
            // La consulta SELECT falló
            echo 'Error al consultar la base de datos';
        } else {
            if ($resultado->num_rows === 0) {
                // No se encontraron filas en la tabla "nombre"
                echo '<p style="color:#6F7789;position:absolute;font-size:30px;left:290px;top:280px;z-index:99">No se han encontrado conflictos asociadas a este nivel</p>';
            } else {
                foreach ($resultado as $row) {
                    $conflictos[] = $row;
                }
            }
        }
        return $conflictos;
    }
}
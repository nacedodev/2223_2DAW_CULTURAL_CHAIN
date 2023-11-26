<?php
class Conflicto {
 /** @var mysqli Conexión a la base de datos. */
    private $conexion;
   
    /**
     * Constructor de la clase Conflicto.
     * Inicia la conexión a la base de datos.
     */
    public function __construct() { 
       
        $this->conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);


    }
    /**
     * Añade una nueva clase a la base de datos.
     *
     * @param string $nombreConflicto Nombre del conflicto.
     * @param int    $posX            Posición X.
     * @param int    $posY            Posición Y.
     * @param string $estado          Estado del conflicto.
     * @param int    $nivel_id        ID del nivel asociado al conflicto.
     */
    public function aniadir($nombreConflicto, $posX, $posY,$estado,$nivel_id) {
        //$imagen = $this->conexion->real_escape_string($imagen);
        $query = "INSERT INTO Conflicto (nombreconflicto,posx,posy,estadoconflicto,nivel_id) VALUES ('$nombreConflicto',$posX,$posY,'$estado',$nivel_id)";
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
     * Modifica un conflicto existente en la base de datos.
     *
     * @param int    $id            ID del conflicto a modificar.
     * @param string $nombreconflicto Nuevo nombre del conflicto.
     * @param string $estado        Nuevo estado del conflicto.
     * @param int    $ejex          Nueva posición X.
     * @param int    $ejey          Nueva posición Y.
     * @return bool                 True si la modificación fue exitosa, false de lo contrario.
     */
    public function modificar($id,$nombreconflicto,$estado,$ejex,$ejey) {
        $query = "UPDATE Conflicto SET nombreconflicto = '$nombreconflicto' , estadoconflicto = '$estado', posx = '$ejex',  posy = '$ejey' WHERE id = '$id'";
        echo $query;
        $resultado = $this->conexion->query($query);
        return $resultado;
    }
    /**
     * Borra un conflicto de la base de datos.
     *
     * @param int $id ID del conflicto a borrar.
     */
    public function borrar($id) {
        try {
            $query = "DELETE FROM Conflicto WHERE id = '$id'";
            $resultado = $this->conexion->query($query);
    
            if ($resultado === false) {
               echo 'Error al eliminar la conflicto ';
            }
            //código de error de la existencia en otras tablas
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1451) {
                
                echo 'conflicto tiene valores en otras tablas';
            } 
        }
    }
    /**
     * Lista todos los conflictos asociados a un nivel específico.
     *
     * @param int $nivel_id ID del nivel asociado a los conflictos.
     * @return array        Arreglo asociativo con los datos de los conflictos.
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
                echo '<p id="error">No se han encontrado conflictos asociadas a este nivel</p>';
            } else {
                foreach ($resultado as $row) {
                    $conflictos[] = $row;
                }
            }
        }
        return $conflictos;
    }
}
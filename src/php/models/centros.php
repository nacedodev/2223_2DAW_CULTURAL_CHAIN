<?php

class Centro {
    
    public function __construct() { 
        require '../config/config_db.php';
        $this->conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);
    }

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

    public function modificar($id,$nombre,$localidad) {
        $query = "UPDATE Centro SET nombre = '$nombre', localidad = '$localidad' WHERE id = $id";
        $resultado = $this->conexion->query($query);
        return $resultado;
    }

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
                echo '<div><p>No se encontraron registros en la tabla "centros"</p></div>';
            } else {
                foreach ($resultado as $row) {
                    $centros[] = $row;
                }
            }
        }
        return $centros;
    }
}

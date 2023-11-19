<?php
class Clase {

    private $conexion;
    private $driver; 
    
    public function __construct() { 
       
        $this->conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);


    }

    public function aniadir($etapa, $clase,$centro_id) {
        $query = "INSERT INTO Clase (etapa, clase, centro_id) VALUES ('$etapa', '$clase', '$centro_id')";
        
        
            try {
                $resultado = $this->conexion->query($query);
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() === 1062) {
                    // Código 1062 indica una violación de clave única
                    echo 'nombre duplicado';
                } 
            }
    }
    

    public function modificar($id,$etapa,$clase) {
        $query = "UPDATE Clase SET etapa = '$etapa', clase = '$clase' WHERE id = '$id'";
        $resultado = $this->conexion->query($query);
        return $resultado;
    }

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
    public function listar($centro_id) {
        $query = "SELECT * FROM Clase WHERE centro_id = '$centro_id'";

        $resultado = $this->conexion->query($query); 
        $centros = [];

        if ($resultado === false) {
            // La consulta SELECT falló
            echo 'Error al consultar la base de datos';
        } else {
            if ($resultado->num_rows === 0) {
                // No se encontraron filas en la tabla "nombre"
                echo '<p style="color:#6F7789;position:absolute;font-size:30px;left:290px;top:280px;z-index:99">No se han encontrado clases asociadas a este centro</p>';
            } else {
                foreach ($resultado as $row) {
                    $centros[] = $row;
                }
            }
        }
        return $centros;
    }
}

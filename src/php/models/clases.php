<?php

class Clase {
    
    public function __construct() { 
        require '../config/config_db.php';
        $this->conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);
    }

    public function aniadir($etapa, $clase) {
            $query = "INSERT INTO clase (etapa, c) VALUES ('$etapa', '$clase')";
    
        
            try {
                $resultado = $this->conexion->query($query);
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() === 1062) {
                    // Código 1062 indica una violación de clave única
                    echo 'nombre duplicado';
                } 
            }
    }
    

    public function modificar() {
       
    }

    public function borrar($id) {
    
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
                echo 'No se encontraron registros en la tabla "centros"';
            } else {
                foreach ($resultado as $row) {
                    $centros[] = $row;
                }
            }
        }
        return $centros;
    }
}

<?php

class Clase {
    
    public function __construct() { 
        require '../config/config_db.php';
        $this->conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);
    }

    public function añadir() {
      
    }

    public function modificar() {
       
    }

    public function borrar($id) {
    
    }
    public function listar() {
        $query= 'SELECT * FROM clases';
        $resultado = $this->conexion->query($query); 
        $clases = [];

        if ($resultado === false) {
            // La consulta SELECT falló
            echo 'Error al consultar la base de datos';
        } else {
            if ($resultado->num_rows === 0) {
                // No se encontraron filas en la tabla "lugar"
                echo 'No se encontraron registros en la tabla "clases$clases"';
            } else {
                foreach ($resultado as $row) {
                    $clases[] = $row;
                }
            }
        }
        return $clases;
    }
}

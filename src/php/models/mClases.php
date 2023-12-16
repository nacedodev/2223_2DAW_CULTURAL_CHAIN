<?php
class mClase {
 /** @var mysqli Conexión a la base de datos. */
    private $conexion;
   
     /**
     * Constructor de la clase Clase.
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
     * Añade una nueva clase a la base de datos.
     *
     * @param string $etapa      Etapa de la clase.
     * @param string $clase      Nombre de la clase.
     * @param int    $centro_id  ID del centro asociado a la clase.
     */
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
                echo '<p id="error">No se han encontrado clases asociadas a este centro</p>';
            } else {
                foreach ($resultado as $row) {
                    $centros[] = $row;
                }
            }
        }
        return $centros;
    }
}
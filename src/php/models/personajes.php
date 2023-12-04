<?php
/**
 * Clase para la manipulación de datos relacionados con los personajes.
 */
class Personaje {

    private $conexion;
    public $mensaje;

    
    public function __construct($host, $user, $password, $database , $charset)
    {
      // Normalmente a esta variable se le llama $dsn (Data Source Name / Nombre de origen de datos)
      //$dsn = "sqlsrv:Server=$host;Database=$database";
        $dsn = "mysql:host=$host;dbname=$database;charset=$charset";
        try {
            // Establecemos la conexión mediante PDO
            $this->conexion = new PDO($dsn, $user, $password);
            // Configuración para que PDO lance excepciones en errores
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
        }
    }
     /** Añade nuevos personajes a la base de datos.
     *
     * @param array $nombre.
     * @param array $imagenPersonaje 
     */

     public function aniadir(array $imagenes, array $nombres)
     {
         try {
             $this->conexion->beginTransaction();
             $sql = 'INSERT INTO Personaje (nombre, imagenPersonaje) VALUES (?, ?)';
             $consulta = $this->conexion->prepare($sql);
             $consulta->bindParam(1, $nombre, PDO::PARAM_STR);
             $consulta->bindParam(2, $imagenBinaria, PDO::PARAM_LOB);

             $index = 0;
             $totalPersonajes = count($nombres);
             var_dump(count($nombres));
             
             while ($index < $totalPersonajes) {
                 $nombre = $nombres[$index];
                 $imagenTmp = $imagenes['tmp_name'][$index];
                 $imagenBinaria = file_get_contents($imagenTmp);
                 
                 $consulta->execute();
                 
                 $index++;
             }
             
             $this->conexion->commit(); 
         } catch (PDOException $e) {
             $this->conexion->rollBack();
             // Manejar la excepción si ocurre algún error al insertar en la base de datos
         }
     }
     
     
     public function borrar(int $id)
    {
        try {
            $sql = "DELETE FROM Personaje WHERE id = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindParam(1, $id, PDO::PARAM_INT);
            $consulta->execute();

     
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                // Código de error para violación de clave foránea
                echo 'El centro tiene valores asociados en otras tablas';
            } else {
                echo 'Error al eliminar el centro: ' . $e->getMessage();
            }
        }
    }
     /**
     * Lista todos los personajes registrados en la base de datos.
     *
     * @return array Array con los datos de los personajes.
     */
    public function listar(): array
    {
        try {
            $sql = 'SELECT * FROM Personaje';
            $consulta = $this->conexion->query($sql);

            if ($consulta === false) {
                $this->mensaje = 'Error al consultar la base de datos';
                return [];
            }

            $personajes = $consulta->fetchAll(PDO::FETCH_ASSOC);

            return $personajes; // Devolver los datos de los personajes
        } catch (PDOException $e) {
            echo 'Error al listar los centros: ' . $e->getMessage();
            return [];
        }
    }

    public function obtenerImagenPorId($id) {
        $query = "SELECT imagenPersonaje FROM Personaje WHERE id = :id";
        
        $statement = $this->conexion->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
    
        if ($resultado) {
            return base64_encode($resultado['imagenPersonaje']);
        } else {
            return null; 
        }
    }

    public function modificar($id, $nombre, $imagen) {
        if (!empty($imagen)) {
            $query = "UPDATE Personaje SET nombre = :nombre, imagenPersonaje = :imagen WHERE id = :id";
            $statement = $this->conexion->prepare($query);
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':imagen', $imagen);
        } else {
            $query = "UPDATE Personaje SET nombre = :nombre WHERE id = :id";
            $statement = $this->conexion->prepare($query);
            $statement->bindParam(':nombre', $nombre);
        }
        
        $statement->bindParam(':id', $id);
        $resultado = $statement->execute();
        
        return $resultado;
    }
    
    
    
    
    
}

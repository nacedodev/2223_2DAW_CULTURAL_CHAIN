<?php

/**
 * Clase para la manipulación de datos relacionados con los centros.
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
     /* Añade nuevos personajes a la base de datos.
     *
     * @param string $nombre     Nombre del centro.
     * @param string $pais  Localidad del centro.
     * @param string $imagenPersonaje 
     */

    public function aniadir($nombre, $pais, $imagenPersonaje)
    {
        try {
            $sql = 'INSERT INTO Personaje (nombre, pais, imagenPersonaje) VALUES (?, ?, ?)';
            $consulta = $this->conexion->prepare($sql);

            // Preparar los statement placeholders una vez fuera del bucle
            $consulta->bindParam(1, $nombre, PDO::PARAM_STR);
            $consulta->bindParam(2, $pais, PDO::PARAM_STR);
            $consulta->bindParam(3, $imagenPersonaje, PDO::PARAM_LOB);
            
            $consulta->execute();
           
        } catch (PDOException $e) {
            // Si ocurre un error, revertir la transacción y manejar la excepción
            if ($e->getCode() === '23000') {
                // Código de error para violación de clave única
                echo 'Nombre duplicado: ya existe un registro con ese nombre';
            } else {
                // Otro tipo de error
                echo 'Error al añadir el centro: ' . $e->getMessage();
            }
        }
    }

    public function borrar(int $id)
    {
        try {
            $sql = "DELETE FROM Personaje WHERE id = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindParam(1, $id, PDO::PARAM_INT);
            $consulta->execute();

            // // Verificar si se eliminó alguna fila
            // if ($consulta->rowCount() === 0) {
            //     echo 'No se encontró ningún personaje con el ID proporcionado';
            // }
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
     * @return array Arreglo asociativo con los datos de los personajes.
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

            $reflexiones = $consulta->fetchAll(PDO::FETCH_ASSOC);

            return $reflexiones; // Devolver los datos de los personajes
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

    public function modificar($id, $nombre, $pais, $imagen) {
        if (!empty($imagen)) {
            $query = "UPDATE Personaje SET nombre = :nombre, pais = :pais, imagenPersonaje = :imagen WHERE id = :id";
            $statement = $this->conexion->prepare($query);
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':pais', $pais);
            $statement->bindParam(':imagen', $imagen);
        } else {
            $query = "UPDATE Personaje SET nombre = :nombre, pais = :pais WHERE id = :id";
            $statement = $this->conexion->prepare($query);
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':pais', $pais);
        }
        
        $statement->bindParam(':id', $id);
        $resultado = $statement->execute();
        
        return $resultado;
    }
    
    
    
    
}

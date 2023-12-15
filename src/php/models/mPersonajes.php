<?php
/**
 * Clase para la manipulación de datos relacionados con los personajes.
 */
class mPersonaje {

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
            $this->mensaje = 'Error de conexión: ' . $e->getMessage();
        }
    }
     /** Añade nuevos personajes a la base de datos.
     *
     * @param array $nombres.
     * @param array $imagenes 
     */

     public function aniadir(array $imagenes, array $nombres)
     {
         try {
             $this->conexion->beginTransaction();//Se inicia la transacción
             $sql = 'INSERT INTO Personaje (nombre, imagenPersonaje) VALUES (?, ?)';
             //Se prepara la consulta una sola vez
             $consulta = $this->conexion->prepare($sql);
             //Se asignan los parametros , con su tipo de dato
             $consulta->bindParam(1, $nombre, PDO::PARAM_STR);
             $consulta->bindParam(2, $imagenBinaria, PDO::PARAM_LOB);

             $index = 0;
             $totalPersonajes = count($nombres);
             
             //Se van añadiendo todos los personajes en el while
             while ($index < $totalPersonajes) {
                 $nombre = $nombres[$index];
                 $imagenTmp = $imagenes['tmp_name'][$index];
                 $imagenBinaria = file_get_contents($imagenTmp);
                 
                 $consulta->execute();
                 $index++;
             }
             // Si todo salió bien , se hace commit
             $this->conexion->commit(); 
         } catch (PDOException $e) {
            //Si algo salió mal se hace rollback y se deshacen todos los cambios
             $this->conexion->rollBack();
             if ($e->getCode() === '22001') {
                $this->mensaje = 'El texto excede la longitud permitida';
            } else {
             $this->mensaje = 'Error al añadir el personaje: ' . $e->getMessage();
            }
         }
     }
     
     
     public function borrar(array $ids)
     {
         try {
             $this->conexion->beginTransaction(); // Se inicia la transacción
     
             $sql = "DELETE FROM Personaje WHERE id = ?";
             // Se prepara la consulta una sola vez 
             $consulta = $this->conexion->prepare($sql);
             $consulta->bindParam(1, $id, PDO::PARAM_INT);
     
             $index = 0;
             $totalIDs = count($ids);
     
             // Se van borrando todos los personajes en el while
             while ($index < $totalIDs) {
                 $id = $ids[$index];
                 $consulta->execute();
                 $index++;
             }
     
             //Si todo salió bien , se hace commit
             $this->conexion->commit();
             $this->mensaje = 'Los personajes han sido eliminados correctamente';
         } catch (PDOException $e) {
            //Si algo salió mal se hace rollback y se deshacen todos los cambios
             $this->conexion->rollBack();
             if ($e->getCode() === '23000') {
                 $this->mensaje = 'Error al eliminar el personaje: tiene valores asociados en otras tablas';
             } else {
                 $this->mensaje = 'Error al eliminar el personaje: ' . $e->getMessage();
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
            $this->mensaje = 'Error al listar los personajes: ' . $e->getMessage();
            return [];
        }
    }

    // Función para mostrar una imagen gracias a su ID asociado
    public function obtenerImagenPorId($id) {
        $query = "SELECT imagenPersonaje FROM Personaje WHERE id = :id";
        
        $consulta = $this->conexion->prepare($query);
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    
        if ($resultado) {
            return base64_encode($resultado['imagenPersonaje']);
        } else {
            return null; 
        }
    }

    public function modificar($id, $nombre, $imagen) {
        try {
            if (!empty($imagen)) {
                $query = "UPDATE Personaje SET nombre = :nombre, imagenPersonaje = :imagen WHERE id = :id";
                $consulta = $this->conexion->prepare($query);
                // Esta es otra forma de asignar parametros por PDO , en lugar de poner 1,2.. se puede poner el nombre que se le ha asignado en la consulta , con ':' delante
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':imagen', $imagen);
            } else {
                $query = "UPDATE Personaje SET nombre = :nombre WHERE id = :id";
                $consulta = $this->conexion->prepare($query);
                $consulta->bindParam(':nombre', $nombre);
            }
            
            $consulta->bindParam(':id', $id);
            $resultado = $consulta->execute();
            
            return $resultado;
        } catch(PDOException $e){
            if ($e->getCode() === '22001') {
                $this->mensaje = 'El texto excede la longitud permitida.';
            }
            else {
            $this->mensaje = 'Error al modificar el personaje: '. $e->getMessage();
            }
        }
    }
}

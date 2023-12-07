<?php
/**
 * Clase para la manipulación de datos relacionados con las reflexiones.
 */
class Reflexion {

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
     /* Añade nuevas reflexiones a la base de datos.
     *
     * @param string $nombre     Nombre del centro.
     * @param string $localidad  Localidad del centro.
     */

    public function aniadir(array $titulos, array $contenidos, int $nivel_id)
    {
        try {
            // Se inicia la transacción
            $this->conexion->beginTransaction();
            $sql = 'INSERT INTO Reflexion (titulo, contenido, nivel_id) VALUES (?, ?, ?)';
            // Se prepara la consulta una sola vez
            $consulta = $this->conexion->prepare($sql);

            // asignacion de variables una sola vez
            $consulta->bindParam(1, $titulo, PDO::PARAM_STR);
            $consulta->bindParam(2, $contenido, PDO::PARAM_STR);
            $consulta->bindParam(3, $nivel_id, PDO::PARAM_INT);

            // Iterar sobre los títulos y contenidos para insertar cada reflexión
            $index = 0;
            while ($index < count($titulos)) {
                $titulo = $titulos[$index];
                $contenido = $contenidos[$index];

                // Ejecutar la consulta preparada para cada reflexión
                $consulta->execute();

                // Incrementar el índice
                $index++;
            }
            // Confirmar la transacción si todo salió bien
            $this->conexion->commit();
        } catch (PDOException $e) {
            // Si ocurre un error, revertir la transacción y manejar la excepción
            $this->conexion->rollBack();
            if ($e->getCode() === '23000') {
                $this->mensaje = 'Esta reflexión ya existe';
            } else {
                // Otro tipo de error
                $this->mensaje = 'Error al añadir la reflexión: ' . $e->getMessage();
            }
        }
    }

 /**
     * Borra todas las reflexiones asociadas a un nivel de la base de datos.
     *
     * @param int $id ID del nivel que se desean borrar sus reflexiones.
     */
    public function borrar(int $nivel_id)
    {
        try {
            $this->conexion->beginTransaction(); //Se inicia la transacción
            // Se prepara la consulta
            $sql = "DELETE FROM Reflexion WHERE nivel_id = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindParam(1, $nivel_id, PDO::PARAM_INT);
            $consulta->execute();

            // Si todo salió bien , se hace commit
            $this->conexion->commit();
        } catch (PDOException $e) {
            // Si algo salió mal , se hace rollback
            $this->conexion->rollBack();
            if ($e->getCode() === '23000') {
                // Error personalizado de foreign key
                $this->mensaje = 'La reflexión tiene valores asociados en otras tablas';
            } else {
                $this->mensaje = 'Error al eliminar las reflexiones: ' . $e->getMessage();
            }
        }
    }
     /**
     * Lista todas las reflexiones asociadas a un nivel.
     *
     * @return array array asociativo con los datos de las reflexiones.
     */
    public function listar($nivel_id): array
    {
        try {
            $sql = 'SELECT titulo, contenido FROM Reflexion WHERE nivel_id = ' . $nivel_id;
            // Se prepara la consulta
            $consulta = $this->conexion->query($sql);

            if ($consulta === false) {
                $this->mensaje = 'Error al consultar la base de datos';
                return [];
            }

            $reflexiones = $consulta->fetchAll(PDO::FETCH_ASSOC);

            return $reflexiones; // Devolver los datos de las reflexiones
        } catch (PDOException $e) {
            $this->mensaje = 'Error al listar las reflexiones: ' . $e->getMessage();
            return [];
        }
    }

}

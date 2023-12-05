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
            $this->conexion->beginTransaction();
            $sql = 'INSERT INTO Reflexion (titulo, contenido, nivel_id) VALUES (?, ?, ?)';
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
                // Código de error para violación de clave única
                echo 'Nombre duplicado: ya existe un registro con ese nombre';
            } else {
                // Otro tipo de error
                echo 'Error al añadir el centro: ' . $e->getMessage();
            }
        }
    }

 /**
     * Borra todas las reflexiones asociadas a un nivel de la base de datos.
     *
     * @param int $id ID de la reflexión a borrar.
     */
    public function borrar(int $nivel_id)
    {
        try {
            $sql = "DELETE FROM Reflexion WHERE nivel_id = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindParam(1, $nivel_id, PDO::PARAM_INT);
            $consulta->execute();

            // // Verificar si se eliminó alguna fila
            // if ($consulta->rowCount() === 0) {
            //     echo 'No se encontró ningúna reflexión con el ID proporcionado';
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
     * Lista todas las reflexiones registrados en la base de datos.
     *
     * @return array Arreglo asociativo con los datos de las reflexiones.
     */
    public function listar($nivel_id): array
    {
        try {
            $sql = 'SELECT titulo, contenido FROM Reflexion WHERE nivel_id = ' . $nivel_id;
            $consulta = $this->conexion->query($sql);

            if ($consulta === false) {
                $this->mensaje = 'Error al consultar la base de datos';
                return [];
            }

            $reflexiones = $consulta->fetchAll(PDO::FETCH_ASSOC);

            return $reflexiones; // Devolver los datos de las reflexiones
        } catch (PDOException $e) {
            echo 'Error al listar los centros: ' . $e->getMessage();
            return [];
        }
    }

}

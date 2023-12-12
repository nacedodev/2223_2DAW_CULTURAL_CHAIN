<?php

/**
 * Clase para la manipulación de datos relacionados con los centros.
 */
class Centro {

    private $conexion;

//    public function __construct($host, $user, $password, $database) {
//        $dsn = "sqlsrv:Server=$host;Database=$database";

    public function __construct($host, $user, $password, $database , $charset)
    {
        // Normalmente a esta variable se le llama $dsn (Data Source Name / Nombre de origen de datos)
        //acceder sin seleccionar bd
        $cadenaConexion = "mysql:host=$host;dbname=$database;charset=$charset";
        try {
            // Establecemos la conexión mediante PDO
            $this->conexion = new PDO($cadenaConexion, $user, $password);
            // Configuración para que PDO lance excepciones en errores
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
        }
    }
     /* Añade un nuevo centro a la base de datos.
     *
     * @param string $nombre     Nombre del centro.
     * @param string $localidad  Localidad del centro.
     */

    public function aniadir($nombre, $localidad)
    {
        try {
            $sql = 'INSERT INTO Centro (nombre, localidad) VALUES (?, ?)';
            $consulta = $this->conexion->prepare($sql);

            $consulta->bindParam(1, $nombre, PDO::PARAM_STR);
            $consulta->bindParam(2, $localidad, PDO::PARAM_STR);

            $consulta->execute();
            // Opcionalmente, se puede  devolver el ID de la fila insertada
            // return $this->conexion->lastInsertId();
        } catch (PDOException $e) {
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
     * Modifica un centro existente en la base de datos.
     *
     * @param int $id         ID del centro a modificar.
     * @param string $nombre     Nuevo nombre del centro.
     * @param string $localidad  Nueva localidad del centro.
     * @return bool              True si la modificación fue exitosa, false de lo contrario.
     */
    public function modificar(int $id, string $nombre, string $localidad): bool
    {
        try {
            $sql = 'UPDATE Centro SET nombre = ?, localidad = ? WHERE id = ?';
            $consulta = $this->conexion->prepare($sql);

            $consulta->bindParam(1, $nombre, PDO::PARAM_STR); // No es necesario especificar PARAM_STR ya que es el valor por defecto
            $consulta->bindParam(2, $localidad, PDO::PARAM_STR);
            $consulta->bindParam(3, $id, PDO::PARAM_INT);

            $consulta->execute();
            return true; // devuelve true si el update fue correcto
        } catch (PDOException $e) {
            echo 'Error al modificar el centro: ' . $e->getMessage();
            return false; //devuelve false si ocurrio algún error
        }
    }
 /**
     * Borra un centro de la base de datos.
     *
     * @param int $id ID del centro a borrar.
     */
    public function borrar(int $id)
    {
        try {
            $sql = 'DELETE FROM Centro WHERE id = ?';
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindParam(1, $id, PDO::PARAM_INT);
            $consulta->execute();

            // Verificar si se eliminó alguna fila
            if ($consulta->rowCount() === 0) {
                echo 'No se encontró ningún centro con el ID proporcionado';
            } else {
                echo 'Centro eliminado exitosamente';
            }
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
     * Lista todos los centros registrados en la base de datos.
     *
     * @return array Arreglo asociativo con los datos de los centros.
     */
    public function listar(): array
    {
        try {
            $sql = 'SELECT * FROM Centro';
            $consulta = $this->conexion->query($sql);

            if ($consulta === false) {
                // La consulta SELECT falló
                echo 'Error al consultar la base de datos';
                return [];
            }

            $centros = $consulta->fetchAll(PDO::FETCH_ASSOC);

            if (empty($centros)) {
                // No se encontraron filas en la tabla "Centro"
                echo '<p id="error">No hay centros registrados</p>';
            }

            return $centros;
        } catch (PDOException $e) {
            echo 'Error al listar los centros: ' . $e->getMessage();
            return [];
        }
    }

}

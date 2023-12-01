<?php

/**
 * Clase para la manipulación de datos relacionados con las reflexiones.
 */
class Administracion {

    private $conexion;
    public $mensaje;

//    public function __construct($host, $user, $password, $database) {
//        $dsn = "sqlsrv:Server=$host;Database=$database";

    public function __construct($host, $user, $password, $database , $charset)
    {
        // Normalmente a esta variable se le llama $dsn (Data Source Name / Nombre de origen de datos)
//        acceder sin seleccionar bd
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

     public function verificarTablas() {
        try {
            // Crear conexión PDO
    
            // Obtener lista de tablas en la base de datos
            $consulta = $this->conexion->query("SHOW TABLES");
            $tables = $consulta->fetchAll(PDO::FETCH_COLUMN);
    
            // Verificar si las tablas tienen al menos una fila
            $allTablesHaveData = true;
            foreach ($tables as $table) {
                $consulta = $this->conexion->query("SELECT COUNT(*) FROM $table");
                $rowCount = $consulta->fetchColumn();
                if ($rowCount === 0) {
                    $allTablesHaveData = false;
                    echo "La tabla '$table' no tiene filas.<br>";
                }
            }
    
            // Verificar si hay al menos una reflexión por cada nivel
            $consultaReflexiones = $this->conexion->query("SELECT Nivel.nombrepais FROM Nivel LEFT JOIN Reflexion ON Nivel.id = Reflexion.nivel_id GROUP BY Nivel.nombrepais HAVING COUNT(Reflexion.id) = 0");
            $nivelesSinReflexiones = $consultaReflexiones->fetchAll(PDO::FETCH_COLUMN);
            if (!empty($nivelesSinReflexiones)) {
                $allTablesHaveData = false;
                echo "Los siguientes niveles no tienen al menos una reflexión asociada: " . implode(', ', $nivelesSinReflexiones) . "<br>";
            }
    
            // Mostrar el resultado final
            if ($allTablesHaveData) {
                echo "¡Todas las tablas tienen al menos una fila y cada nivel tiene al menos una reflexión!";
            } else {
                echo "Algunas tablas no tienen filas o algunos niveles no tienen reflexiones, verifica tus datos antes de salir a producción.";
            }
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    
        // Cerrar la conexión
        $this->conexion = null;
    }
    

} 

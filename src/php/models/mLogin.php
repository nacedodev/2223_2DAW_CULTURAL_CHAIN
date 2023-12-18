<?php
    require_once '../php/config/config_db.php';
    
    class mLogin {
        private $conexion;
    
        public function __construct() {
            $this->conexion = new mysqli(HOST, USER, PASSWORD, DATABASE);
            if ($this->conexion->connect_error) {
                die("Connection failed: " . $this->conexion->connect_error);
            }
        }
    
        public function verificar($email, $password) {
            $email = $this->conexion->real_escape_string($email);
        
            // Preparar la consulta preparada para seleccionar el usuario por email
            $sql = "SELECT id, nombre, perfil, pwd FROM us_admin WHERE email = ?";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bind_param("s", $email);
            $consulta->execute();
            $consulta->store_result();
        
        
                if ($consulta->num_rows > 0) {
                    $consulta->bind_result($id, $nombre, $perfil, $password_hash);
                    $consulta->fetch();
        
                    // Verificar la contraseña utilizando password_verify
                    if (password_verify($password, $password_hash)) {
                        $_SESSION['id'] = $id;
                        $_SESSION['nombre'] = $nombre;
                        $_SESSION['perfil'] = $perfil;
                        return true; // Credenciales válidas
                    }
            }
            return false; // Credenciales inválidas
        }

        public function numUsuarios() {
            $sql = "SELECT COUNT(*) as total FROM us_admin";
            $result = $this->conexion->query($sql);
    
            if ($result) {
                $row = $result->fetch_assoc();
                return $row['total'];
            } else {
                return 0; 
            }
        }

        public function registro($email, $password, $nombre, $perfil) {
            
            $email = $this->conexion->real_escape_string($email);
            $nombre = $this->conexion->real_escape_string($nombre);
        
            // Preparar la consulta preparada para insertar un nuevo administrador
            $sql = "INSERT INTO us_admin (email, pwd, nombre, perfil) VALUES (?, ?, ?, ?)";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bind_param("ssss", $email, $password, $nombre, $perfil);
            
            if ($consulta) {
                $consulta->execute();
                
                if ($consulta->affected_rows > 0) {
                    // Si es el primer usuario que se crea ,es decir el super administrador , asignar  el nombre y el perfil para no tener que iniciar sesion justo despues de registrarse ya que no tiene sentido 
                    if($this->numUsuarios() == 1){
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['perfil'] = $perfil;
                    }
                    return true; // Registro exitoso
                }
            }
            return false; // No se pudo registrar
        }
    }


<?php
require_once '../php/models/mLogin.php';
class Login {
    private $objLogin;
    public $view;

    public $mensaje;

    public function __construct() {
        $this->objLogin = new mLogin();
    }
    public function mostrarLogin(){

        if($this->objLogin->numUsuarios() == 0){
            $this->view='sregistro';
        } else {
            $this->view='login';
        }
    }

    public function mostrarAdmin(){
        $this->view = 'admin';
    }
    
    public function verificarCredenciales() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            if ($this->objLogin->verificar($email,$password)) {
                
                if(isset($_SESSION['perfil']))
                    $this->view = 'admin';
                
            } else {
                $this->mensaje = 'Credenciales inválidas';
            }
            
            if(isset($this->mensaje)) {
               $this->view = 'login';
            }
        }
        else {
            $this->view='login'; 
        }
    }

    public function registroInstalacion() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $nombre = $_POST['nombre'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $perfil = 's';
            
            if ($this->objLogin->registro($email,$password,$nombre,$perfil)) {
               $this->view = 'admin'; 
            }
            else {
                $this->mensaje = 'Error al registrar';
                $this->view = 'login';
            }
                
        }
        else {
            $this->view='sregistro'; 
        } 
    }

    public function registrarAdmin() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $nombre = $_POST['nombre'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $perfil = 'a';
            
            if ($this->objLogin->registro($email,$password,$nombre,$perfil)) {
                $this->mensaje = 'Registro realizado con exito.';
                $this->view = 'aregistro';
            }
            else {
                $this->mensaje = 'Error al registrar';
                $this->view = 'aregistro';
            }
                
        } else {
            $this->view = 'aregistro';
        }
    }

    public function cerrarSesion(){
        session_destroy();
        $this->view = 'login';
    }

}
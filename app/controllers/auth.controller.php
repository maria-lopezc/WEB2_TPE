<?php
require_once './app/models/user.model.php';
require_once './app/views/auth.view.php';

class AuthController{
    private $model;
    private $view;

    public function __construct(){
        $this->model= new UserModel();
        $this->view= new AuthView();
    }

    public function showLogin(){
        return $this->view->showLogin();
    }

    public function login(){
        if(!isset ($_POST['usuario'])||empty($_POST['usuario'])){
            return $this->view->showLogin('');
        }
        if(!isset ($_POST['contrasena'])||empty($_POST['contrasena'])){
            return $this->view->showLogin('');
        } 

        $usuario=$_POST['usuario'];
        $contrasena=$_POST['contrasena'];
         
        $userFromDB=$this->model->getUserByUsuario($usuario);
        
        if($userFromDB&&password_verify($contrasena, $userFromDB->contrasena)){
            $_SESSION['ID_USER']=$userFromDB->id;
            $_SESSION['USUARIO_USER']=$userFromDB->email;
            $_SESSION['LAST_ACTIVITY']=time();

            header("Location: ".BASE_URL);
        } else{
            return $this->view->showLogin('Email o contraseña incorrectas');
        }
    }

    public function logout(){
        session_destroy();

        header("Location: ".BASE_URL);
    }
}
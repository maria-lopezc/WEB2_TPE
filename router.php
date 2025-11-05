<?php
require_once 'app/controllers/libreria.controller.php';
require_once 'app/controllers/auth.controller.php';
require_once 'app/libs/response.php';
require_once 'app/middlewares/session.auth.middleware.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');


$res=new Response();

//---------------TABLA DE RUTEO------------------------
//home->verLibros()
//libro/:id->verLibro(:id)
//login->login()
//logout->logout()
//showLogin->showLogin()
//add->addLibro()
//delete->deleteLibro(:id)
//edit->showToEdit(:id)
//editar->editLibro(:id)
//autores-->verAutores()
//-----------------------------------------------------

if(!empty ($_GET['action'])){
    $action=$_GET['action'];
} else {
    $action='home';
}

$libreriaController=new libreriaController();
$authController=new AuthController();

$params=explode("/",$action);

switch($params[0]){
    case 'home': 
        $libreriaController->showHome(); 
        break;
    case 'libro':
        if(isset($params[1])&&!empty($params[1])){
            $libreriaController->showLibro($params[1]);
        } else {
            header("Location: ".BASE_URL);
        }
         
        break;
    case 'showLogin': 
        $authController->showLogin();
        break;
    case 'login': 
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'add':
        sessionAuthMiddleware($res);
        $libreriaController->addLibro();
        break;
    case 'delete':
        sessionAuthMiddleware($res);
        $libreriaController->deleteLibro($params[1]);
        break;
    case 'edit':
        sessionAuthMiddleware($res);
        $libreriaController->showToEdit($params[1]);
        break;
    case 'editar':
        sessionAuthMiddleware($res);
        $libreriaController->editLibro($params[1]);
        break;
    case 'autores':
        $libreriaController -> verAutores();
        break;
    case 'obras':
        $libreriaController -> verObras($params[1]);
        break;
    case 'addAutores':
         sessionAuthMiddleware($res);
        $libreriaController -> addAutores();
        break;
    case 'deleteAutor':
         sessionAuthMiddleware($res);
        $libreriaController -> deleteAutor($params[1]);
        break;
    case 'editAutor':
         sessionAuthMiddleware($res);
        $libreriaController -> editAutor($params[1]);
        break;
    case 'editarAutor':
         sessionAuthMiddleware($res);
        $libreriaController -> editarAutor($params[1]);
        break;
}
?>
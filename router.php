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
        $libreriaController->showLibro($params[1]); 
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
        $libreriaController->addLibro();
        break;
    case 'delete':
        $libreriaController->deleteLibro($params[1]);
        break;
    case 'edit':
        $libreriaController->showToEdit($params[1]);
        break;
    case 'editar':
        $libreriaController->editLibro($params[1]);
        break;
    case 'autores':
        $libreriaController -> verAutores();
        break;
    case 'obras':
        $libreriaController -> verObras($params[1]);
        break;
    case 'addAutores':
        $libreriaController -> addAutores();
        break;
    case 'deleteAutor':
        $libreriaController -> deleteAutor($params[1]);
        break;
    case 'editAutor':
        $libreriaController -> editAutor($params[1]);
        break;
    case 'editarAutor':
        $libreriaController -> editarAutor($params[1]);
        break;
}
?>
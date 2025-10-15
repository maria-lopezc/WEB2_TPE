<?php
require_once 'app/controllers/libreria.controller.php';

//TABLA DE RUTEO
//home->verLibros()
//libro/:id->verLibro(:id)

if(!empty ($_GET['action'])){
    $action=$_GET['action'];
} else {
    $action='home';
}

$libreriaController=new libreriaController();

$params=explode("/",$action);

switch($params[0]){
    case 'home': 
        $libreriaController->showHome(); 
        break;
    case 'libro':
        $libreriaController->showLibro($params[1]); 
        break;
}
?>
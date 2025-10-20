<?php
if (session_status() === PHP_SESSION_NONE) session_start();

function sessionAuthMiddleware($response){
    if(isset($_SESSION['ID_USER'])){
        $response->user= new stdClass();
        $response->user->id=$_SESSION['ID_USER'];
        $response->user->usuario=$_SESSION['USUARIO_USER'];
    } else{
        $redirect=BASE_URL;
        header('Location: '.$redirect);
        die();
    }
}
?>
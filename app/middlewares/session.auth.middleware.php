<?php
function sessionAuthMiddleware($response){
    session_start();
    if(isset($_SESSION['ID_USER'])){
        $response->user= new stdClass();
        $response->user->id=$_SESSION['ID_USER'];
        $response->user->usuario=$_SESSION['USUARIO_USER'];
    } else{
        $redirect="/WEB2_TPE/showLogin/";
        header('Location: '.$redirect);
        die();
    }
}
?>
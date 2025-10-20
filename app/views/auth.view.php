<?php
class AuthView{
    public function showLogin($error=' '){
        require_once 'templates/header.php';
        if($error) :
            echo $error;
        endif;
        
        require 'templates/form_login.phtml';
    }
}
<?php
class AuthView{
    public function showLogin($error=' '){
        if($error) :
            echo $error;
        endif;
        require 'templates/form_login.phtml';
    }
}
<?php
class LibreriaView{
    function showHome($libros){
        require_once 'templates/header.php';  
        require 'templates/vista_home.phtml';
        foreach($libros as $libro){
            require "templates/vista_libros_home.phtml";
        }
    }
    

    function showLibro($libro, $autor){    
        require_once 'templates/header.php';
        require 'templates/vista_libro.phtml';
    }

    function showAdd($autores){    
        require_once 'templates/header.php';
        require 'templates/form_add.phtml';
    }

    function showToEdit($autores,$libro){
        require_once 'templates/header.php';
        require 'templates/form_edit.phtml';
    }
}
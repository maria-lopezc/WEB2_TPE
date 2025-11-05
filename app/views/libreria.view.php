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

    function showAutores($autores) {
        require_once 'templates/header.php';  
        require 'templates/vista_autores.phtml';
        foreach($autores as $autor){
            require "templates/vista_autor.phtml";
        }
    }

    function showObras($libros) {
        require_once 'templates/header.php';  
        require 'templates/vista_obras.phtml';
        foreach($libros as $libro){
            require "templates/vista_obra.phtml";
        }
    }

    function showAddAutor() {
         require_once 'templates/header.php';
        require 'templates/form_addAutores.phtml';
    }

    function showToEditAutor($autor) {
        require_once 'templates/header.php';
        require 'templates/form_edit_autor.phtml';
    }
}
<?php
class LibreriaView{
    function showHome($autores, $libros){  
        require 'templates/vista_home.phtml';
        foreach($libros as $libro){ //esto al view o al controller?
            $autor=0;
            foreach ($autores as $aa) {
                if ($aa->id_autor === $libro->id_autor) {
                    $autor = $aa;
                    require "templates/vista_libros_home.phtml";
                    break;// Salimos del bucle una vez encontrado
                }
            }
        }
    }

    function showLibro($libro, $autor){
        if (isset($_SESSION['ID_USER'])){
            require 'templates/vista_libro_admin.phtml';
        } else {
            require 'templates/vista_libro_reg.phtml';
        }
    }

    function showAdd($autores){
        require 'templates/form_add.phtml';
    }

    function showToEdit($autores,$libro){
        require 'templates/form_edit.phtml';
    }
}
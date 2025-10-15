<?php
require_once 'templates/header.php';
require_once './app/models/libreria.model.php';
require_once './app/views/libreria.view.php';

class LibreriaController{
    private $model;
    private $view;

    public function __construct(){
        $this->model= new LibreriaModel();
        $this->view= new LibreriaView();
    }

    function showHome(){ 
        $autores=$this->model->getAutores();
        $libros=$this->model->getLibros();
        $this->view->showHome($autores, $libros);
    }

    function showLibro($id){
        $libro=$this->model->getLibro($id);
        $autores=$this->model->getAutores(); //esto lo puede hacer el controller?
        foreach ($autores as $aa) {
            if ($aa->id_autor == $libro->id_autor) {
                $this->view->showLibro($libro, $aa);
                break;
            }
        }
    }
}
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

    public function showHome(){
        $autores=$this->model->getAutores();
        $libros=$this->model->getLibros(); 
        if (isset($_SESSION['ID_USER'])):
            $this->view->showAdd($autores);
        endif;
        $this->view->showHome($autores, $libros);
    }

    public function showLibro($id){
        $libro=$this->model->getLibro($id);
        if($libro!=null){
            $autores=$this->model->getAutores();
            foreach ($autores as $aa) {
                if ($aa->id_autor == $libro->id_autor) {
                    $this->view->showLibro($libro, $aa);
                    break;
                }
            }
        }else echo "<h3>Este libro no existe</h3>";
    }   

    public function addLibro(){
        if(isset($_POST['titulo'])&&($_POST['id_autor'])&&($_POST['genero']&&($_POST['paginas']))){
            $titulo=$_POST['titulo'];
            $id_autor=$_POST['id_autor'];
            $genero=$_POST['genero'];
            $paginas=$_POST['paginas'];

            $this->model->addLibro($titulo, $id_autor, $genero, $paginas);

            header("Location: /WEB2_TPE/");
        }
    }

    public function deleteLibro($id){
        $this->model->deleteLibro($id);
        header("Location: /WEB2_TPE/");
    }

    public function showToEdit($id){
        $libro=$this->model->getLibro($id);
        $autores=$this->model->getAutores();
        $this->view->showToEdit($autores,$libro);
    }

    public function editLibro($id){
        if(isset($_POST['titulo'])&&($_POST['id_autor'])&&($_POST['genero']&&($_POST['paginas']))){
            $titulo=$_POST['titulo'];
            $id_autor=$_POST['id_autor'];
            $genero=$_POST['genero'];
            $paginas=$_POST['paginas'];

            $this->model->editLibro($titulo, $id_autor, $genero, $paginas,$id);

            header("Location: /WEB2_TPE/");
        }
    }
}
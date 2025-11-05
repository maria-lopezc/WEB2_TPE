<?php
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
        $libros=$this->model->getLibrosYAutores(); 
        if (isset($_SESSION['ID_USER'])):
            $this->view->showAdd($autores);
        endif;
        $this->view->showHome($libros);
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
        }
    }   

    public function addLibro(){
        if(isset($_POST['titulo'])&&!empty($_POST['titulo'])){ //titulo
            $titulo=$_POST['titulo'];
            if(isset($_POST['id_autor'])&&!empty($_POST['id_autor'])){ //id autor
                $id_autor=$_POST['id_autor'];
                $autor=$this->model->getAutor($id_autor);
                if(isset($autor)&&!empty($autor)){ //existe autor
                    if(isset($_POST['genero'])&&!empty($_POST['genero'])){ //genero
                        $genero=$_POST['genero'];
                        if(isset($_POST['paginas'])&&!empty($_POST['paginas'])){ //paginas
                            $paginas=$_POST['paginas'];
                            $this->model->addLibro($titulo, $id_autor, $genero, $paginas);
                            header("Location: ".BASE_URL);
                        }else{
                            header("Location: ".BASE_URL);
                        } 
                    }else{
                        header("Location: ".BASE_URL);
                    }
                }else{
                    header("Location: ".BASE_URL);
                }
            } else{
                header("Location: ".BASE_URL);
            }
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function deleteLibro($id){
        $libro=$this->model->getLibro($id);
        if(isset($libro)&&!empty($libro)){
            $this->model->deleteLibro($id);
        }
        header("Location: ".BASE_URL);
    }

    public function showToEdit($id){
        $libro=$this->model->getLibro($id);
        if(isset($libro)&&!empty($libro)){
            $autores=$this->model->getAutores();
            $this->view->showToEdit($autores,$libro);
        }else{
            header("Location: ".BASE_URL);
        }
    }

    public function editLibro($id){
        $libro=$this->model->getLibro($id);
        if(isset($libro)&&!empty($libro)){
            if(isset($_POST['titulo'])&&!empty($_POST['titulo'])){ //titulo
                $titulo=$_POST['titulo'];
                if(isset($_POST['id_autor'])&&!empty($_POST['id_autor'])){ //id autor
                    $id_autor=$_POST['id_autor'];
                    $autor=$this->model->getAutor($id_autor);
                    if(isset($autor)&&!empty($autor)){ //existe autor
                        if(isset($_POST['genero'])&&!empty($_POST['genero'])){ //genero
                            $genero=$_POST['genero'];
                            if(isset($_POST['paginas'])&&!empty($_POST['paginas'])){ //paginas
                                $paginas=$_POST['paginas'];
                                $this->model->editLibro($titulo, $id_autor, $genero, $paginas,$id);
                                header("Location: ".BASE_URL);
                            }else{;
                                header("Location: ".BASE_URL);
                            } 
                        }else{
                            header("Location: ".BASE_URL);
                        }
                    }else{
                        header("Location: ".BASE_URL);
                    }
                } else{
                    header("Location: ".BASE_URL);
                }
            } else {
                header("Location: ".BASE_URL);
            }
            header("Location: ".BASE_URL);
        }
    }
    
    public function verAutores() {
        if (isset($_SESSION['ID_USER'])):
            $this->view->showAddAutor();
        endif;
        $autores=$this->model->getAutores();
        $this->view->showAutores($autores);   
    }

    public function verObras($id) {
        $libros = $this -> model ->getObras($id);
        $this -> view -> showObras($libros);
    }

    public function addAutores() {
         if(isset($_POST['nombre'])&&($_POST['nacimiento'])&&($_POST['email'])){
            $nombre=$_POST['nombre'];
            $nacimiento=$_POST['nacimiento'];
            $email=$_POST['email'];

            $this->model->addAutores($nombre, $nacimiento, $email);

            header("Location: ".BASE_URL.'autores');
        }
    }
    public function deleteAutor($id) {
         $this->model->deleteAutor($id);
        header("Location: ".BASE_URL.'autores');
    }

    public function editAutor($id) {
        $autor=$this->model->getAutor($id);
        $this->view->showToEditAutor($autor);
    }

    public function editarAutor($id) {
        if(isset($_POST['nombre'])&&($_POST['nacimiento'])&&($_POST['email'])){
            $nombre=$_POST['nombre'];
            $nacimiento=$_POST['nacimiento'];
            $email=$_POST['email'];

            $this->model->editAutor($nombre, $nacimiento, $email,$id);

            header("Location: ".BASE_URL.'autores');
        }
    }
}
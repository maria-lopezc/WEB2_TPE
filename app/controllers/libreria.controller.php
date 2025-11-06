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
        }else{
            header("Location: ".BASE_URL);
        }
    }   

    public function addLibro(){
        if(!isset($libro)||empty($libro)){
             // mensaje de error
            return;
        }
        if(!isset($_POST['titulo']) || empty($_POST['titulo'])){
            // mensaje de error
            return;
        }
        if(!isset($_POST['id_autor'])|| empty($_POST['id_autor'])){
            // mensaje de error
            return;
        }        
        $id_autor=$_POST['id_autor'];
        $autor=$this->model->getAutor($id_autor);
        if(!isset($autor)||empty($autor)){
            // mensaje de error
            return;
        }
        if(!isset($_POST['genero'])|| empty($_POST['genero'])){
            // mensaje de error
            return;
        }
        if(!isset($_POST['paginas'])|| empty($_POST['paginas'])){
            // mensaje de error
            return;
        }
        $titulo=$_POST['titulo'];
        $genero=$_POST['genero'];
        $paginas=$_POST['paginas'];
        $this->model->addLibro($titulo, $id_autor, $genero, $paginas);
        header("Location: ".BASE_URL);
                            
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
        if(!isset($libro)||empty($libro)){
             // mensaje de error
            return;
        }
        if(!isset($_POST['titulo']) || empty($_POST['titulo'])){
            // mensaje de error
            return;
        }
        if(!isset($_POST['id_autor'])|| empty($_POST['id_autor'])){
            // mensaje de error
            return;
        }        
        $id_autor=$_POST['id_autor'];
        $autor=$this->model->getAutor($id_autor);
        if(!isset($autor)||empty($autor)){
            // mensaje de error
            return;
        }
        if(!isset($_POST['genero'])|| empty($_POST['genero'])){
            // mensaje de error
            return;
        }
        if(!isset($_POST['paginas'])|| empty($_POST['paginas'])){
            // mensaje de error
            return;
        }
        $titulo=$_POST['titulo'];
        $genero=$_POST['genero'];
        $paginas=$_POST['paginas'];
        $this->model->editLibro($titulo, $id_autor, $genero, $paginas,$id);
        header("Location: ".BASE_URL);
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
        $autor = $this -> model->getAutor($id);
         if(isset($autor) && !empty($autor)) {
        $this -> view -> showObras($libros, $autor);
        }
    }

    public function addAutores() {
        if(isset($_POST['nombre'])&&!empty($_POST['nombre'])){ //titulo
            $nombre=$_POST['nombre'];
            if(isset($_POST['nacimiento'])&&!empty($_POST['nacimiento'])){
            $nacimiento=$_POST['nacimiento'];
            if(isset($_POST['email'])&&!empty($_POST['email'])){
            $email=$_POST['email'];
            $this->model->addAutores($nombre, $nacimiento, $email);
            }
        }
        }         
            header("Location: ".BASE_URL.'autores');
    }
    public function deleteAutor($id) {
         $autor=$this->model->getAutor($id);
        if(isset($autor) && !empty($autor)) {
            $this->model->deleteAutor($id);
        }
        header("Location: ".BASE_URL.'autores');
    }

    public function editAutor($id) {
        $autor=$this->model->getAutor($id);
        if(isset($autor) && !empty($autor)) {
        $this->view->showToEditAutor($autor);
        } else {
            header("Location: ".BASE_URL.'autores');
        }
    }

    public function editarAutor($id) {
 if(isset($_POST['nombre'])&&!empty($_POST['nombre'])){ //titulo
            $nombre=$_POST['nombre'];
            if(isset($_POST['nacimiento'])&&!empty($_POST['nacimiento'])){
            $nacimiento=$_POST['nacimiento'];
            if(isset($_POST['email'])&&!empty($_POST['email'])){
            $email=$_POST['email'];
            $autor = $this-> model -> getAutor($id);
            if(isset($autor) && !empty($autor)) {
                $this->model->editAutor($nombre, $nacimiento, $email, $id);
            }
            } 
            }
            } header("Location: ".BASE_URL.'autores');
        } 
}
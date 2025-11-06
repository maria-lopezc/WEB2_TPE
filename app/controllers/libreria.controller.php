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

    public function showHome($error=null){
        $error = null;
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);
        }
        $libros=$this->model->getLibrosYAutores(); 
        $this->view->showHome($libros,$error);
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
        if(!isset($_POST['titulo']) || empty($_POST['titulo'])){
            $_SESSION['error'] = "Falta título";
            header("Location: " . BASE_URL);
            die();
        }
        if(!isset($_POST['id_autor'])|| empty($_POST['id_autor'])){
            $_SESSION['error'] = "Falta Autor";
            header("Location: " . BASE_URL);
            die();
        }        
        $id_autor=$_POST['id_autor'];
        $autor=$this->model->getAutor($id_autor);
        if(!isset($autor)||empty($autor)){
            $_SESSION['error'] = "No existe el autor";
            header("Location: " . BASE_URL);
            die();
        }
        if(!isset($_POST['genero'])|| empty($_POST['genero'])){
            $_SESSION['error'] = "Falta Género";
            header("Location: " . BASE_URL);
            die();
        }
        if(!isset($_POST['paginas'])|| empty($_POST['paginas'])){
            $_SESSION['error'] = "Falta Cantidad De Páginas";
            header("Location: " . BASE_URL);
            die();
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
        $error = null;
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);
        }
        $libro=$this->model->getLibro($id);
        if(isset($libro)&&!empty($libro)){
            $autores=$this->model->getAutores();
            $this->view->showToEdit($autores,$libro,$error);
        }else{
            header("Location: ".BASE_URL);
        }
    }

    public function editLibro($id){
        $libro=$this->model->getLibro($id);
        if(!isset($libro)||empty($libro)){
            $_SESSION['error'] = "El Libro No Existe";
            header("Location: " . BASE_URL . "edit/".$id);
            die();
        }
        if(!isset($_POST['titulo']) || empty($_POST['titulo'])){
            $_SESSION['error'] = "Falta título";
            header("Location: " . BASE_URL . "edit/".$id);
            die();
        }
        if(!isset($_POST['id_autor'])|| empty($_POST['id_autor'])){
            $_SESSION['error'] = "Falta autor";
            header("Location: " . BASE_URL . "edit/".$id);
            die();
        }        
        $id_autor=$_POST['id_autor'];
        $autor=$this->model->getAutor($id_autor);
        if(!isset($autor)||empty($autor)){
            $_SESSION['error'] = "El Autor No Existe";
            header("Location: " . BASE_URL . "edit/".$id);
            die();
        }
        if(!isset($_POST['genero'])|| empty($_POST['genero'])){
            $_SESSION['error'] = "Falta Género";
            header("Location: " . BASE_URL . "edit/".$id);
            die();
        }
        if(!isset($_POST['paginas'])|| empty($_POST['paginas'])){
            $_SESSION['error'] = "Falta Cantidad de Páginas";
            header("Location: " . BASE_URL . "edit/".$id);
            die();
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
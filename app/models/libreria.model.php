<?php
require 'config/config.php';
class LibreriaModel{
    protected $db;

    public function __construct(){
        $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
        $this->_deploy();
    }

    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql = <<<END
            CREATE TABLE `autores` (`id_autor` int(11) NOT NULL,`nombre` varchar(100) NOT NULL,`nacimiento` date NOT NULL,`email` varchar(50) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
            INSERT INTO `autores` (`id_autor`, `nombre`, `nacimiento`, `email`) VALUES(1, 'Luciano Añon', '2004-08-03', 'luciano@gmail.com'),(2, 'Julio Verne', '2000-01-01', 'julioverne32@gmail.com'),(3, 'Jose Perez', '1995-06-21', 'joseperez@gmail.com'),(4, 'Juana Rodriguez', '1999-03-08', 'juanarodriguez@gmail.com');
            CREATE TABLE `libros` (`id_libro` int(11) NOT NULL,`id_autor` int(11) NOT NULL,`titulo` varchar(100) NOT NULL,`genero` varchar(100) NOT NULL,`paginas` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
            INSERT INTO `libros` (`id_libro`, `id_autor`, `titulo`, `genero`, `paginas`) VALUES(1, 1, 'El Alquimista', 'Aventura', 100),(2, 3, 'Crimen y castigo', 'Clásico', 500),(3, 3, 'Sherlock Holmes', 'Crimen', 800),(4, 3, 'Hamlet', 'Teatro', 1000),(5, 4, 'El principito', 'Clásico', 2000),(6, 1, 'Martín Fierro', 'Poesia', 500),(7, 2, 'La vuelta al mundo en 80 días', 'Aventura', 4000);
            END;
        $this->db->query($sql);
        }
    }


    public function getLibros(){;
        $sentencia=$this->db->prepare("SELECT * FROM `libros`");
        $sentencia->execute();
        $libros=$sentencia->fetchAll(PDO::FETCH_OBJ);
        return $libros;
    }

    function getLibro($id) {
        $query = $this->db->prepare("SELECT * FROM `libros` WHERE id_libro = ?");
        $query->execute([$id]);
        $libro = $query->fetch(PDO::FETCH_OBJ);
        if ($libro === false) {
            return null;
        }
        return $libro;
    }


     function getAutores(){
        $query=$this->db->prepare("SELECT * FROM `autores`");
        $query->execute();
        $autores=$query->fetchAll(PDO::FETCH_OBJ);
        return $autores;
    }
}
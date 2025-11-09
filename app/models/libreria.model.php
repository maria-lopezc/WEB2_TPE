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
            CREATE TABLE `autores` (`id_autor` int(11)   AUTO_INCREMENT PRIMARY KEY,`nombre` varchar(100) NOT NULL,`nacimiento` date NOT NULL,`email` varchar(50) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
            INSERT INTO `autores` (`id_autor`, `nombre`, `nacimiento`, `email`) VALUES(1, 'Luciano Añon', '2004-08-03', 'luciano@gmail.com'),(2, 'Julio Verne', '2000-01-01', 'julioverne32@gmail.com'),(3, 'Jose Perez', '1995-06-21', 'joseperez@gmail.com'),(4, 'Juana Rodriguez', '1999-03-08', 'juanarodriguez@gmail.com');
            CREATE TABLE `libros` (`id_libro` int(11)  AUTO_INCREMENT PRIMARY KEY,`id_autor` int(11) NOT NULL,`titulo` varchar(100) NOT NULL,`genero` varchar(100) NOT NULL,`paginas` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
            INSERT INTO `libros` (`id_libro`, `id_autor`, `titulo`, `genero`, `paginas`) VALUES(1, 1, 'El Alquimista', 'Aventura', 100),(2, 3, 'Crimen y castigo', 'Clásico', 500),(3, 3, 'Sherlock Holmes', 'Crimen', 800),(4, 3, 'Hamlet', 'Teatro', 1000),(5, 4, 'El principito', 'Clásico', 2000),(6, 1, 'Martín Fierro', 'Poesia', 500),(7, 2, 'La vuelta al mundo en 80 días', 'Aventura', 4000);
            CREATE TABLE `login` (`id` int(11)  AUTO_INCREMENT PRIMARY KEY,`usuario` varchar(100) CHARACTER SET utf16 COLLATE utf16_spanish_ci NOT NULL,`contrasena` varchar(200) CHARACTER SET utf16 COLLATE utf16_spanish2_ci NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
            INSERT INTO `login` (`id`, `usuario`, `contrasena`) VALUES(1, 'webadmin', '\$2y\$10\$ax3bLQBWYdfetJxumbdezuE/Q0OmSwYwSYeNRPsMYuy.svLI8NjZe');
            ALTER TABLE `libros` ADD CONSTRAINT `autor` FOREIGN KEY (`id_autor`) REFERENCES `autores`(`id_autor`) ON DELETE NO ACTION ON UPDATE NO ACTION;
            END;
        $this->db->query($sql);
        }
    }


    function getLibrosYAutores(){;
        $sentencia=$this->db->prepare("SELECT * FROM `libros` INNER JOIN `autores` ON libros.id_autor=autores.id_autor;");
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

    function addLibro($titulo, $id_autor, $genero, $paginas){
        $query=$this->db->prepare('INSERT INTO `libros`(`id_autor`, `titulo`, `genero`, `paginas`) 
        VALUES (?,?,?,?)');
        $query->execute([$id_autor,$titulo, $genero, $paginas]);
    }

    function deleteLibro($id){
        $query=$this->db->prepare('DELETE FROM libros WHERE id_libro = ?');
        $query->execute([$id]);
    }

    function editLibro($titulo, $id_autor, $genero, $paginas,$id_libro){
        $query=$this->db->prepare('UPDATE `libros` SET `id_autor` = ?, `titulo` = ?, `genero` = ?, `paginas` = ? WHERE `libros`.`id_libro` = ?');
        $query->execute([$id_autor,$titulo, $genero, $paginas,$id_libro]);
    }

    function getObras($id){
        $query=$this->db->prepare('SELECT * FROM `libros` WHERE id_autor = ?');
        $query->execute([$id]);
        $libros=$query->fetchAll(PDO::FETCH_OBJ);
        return $libros;
    }

    function addAutores($nombre, $nacimiento, $email){
        $query=$this->db->prepare('INSERT INTO `autores`(`nombre`, `nacimiento`, `email`) 
        VALUES (?,?,?)');
        $query->execute([$nombre,$nacimiento, $email]);
    }
    function deleteAutor($id) {
        $query=$this->db->prepare('DELETE FROM autores WHERE id_autor = ?');
        $query->execute([$id]);
    }
     function getAutor($id) {
        $query = $this->db->prepare("SELECT * FROM autores WHERE id_autor = ?");
        $query->execute([$id]);
        $autor = $query->fetch(PDO::FETCH_OBJ);
        if ($autor === false) {
            return null;
        }
        return $autor;
    }

    function editAutor ($nombre, $nacimiento, $email,$id) {
        $query=$this->db->prepare('UPDATE `autores` SET `nombre` = ?, `nacimiento` = ?, `email` = ? WHERE `autores`.`id_autor` = ?');
        $query->execute([$nombre,$nacimiento, $email, $id]);
    }
}
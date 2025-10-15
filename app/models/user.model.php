<?php
class UserModel{
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
            CREATE TABLE `login` (`id` int(11) NOT NULL,`usuario` varchar(100) CHARACTER SET utf16 COLLATE utf16_spanish_ci NOT NULL,`contrasena` varchar(200) CHARACTER SET utf16 COLLATE utf16_spanish2_ci NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
            END;
        $this->db->query($sql);
        }
    }

    public function getUserByUsuario($usuario){
        $query=$this->db->prepare('SELECT * FROM `login` WHERE usuario=?');
        $query->execute([$usuario]);

        $user=$query->fetch(PDO::FETCH_OBJ);

        var_dump($user);
        return $user;
    }

    function encriptar($pass){
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    function registrar($user, $pass){
        $query=$this->db->prepare('INSERT INTO `login` (`email`, `contrasenia`) VALUES (?, ?)');
        $query->execute([$user, $pass]);
    }
}
<?php
class UserModel{
    protected $db;

    public function __construct(){
        $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }

    public function getUserByUsuario($usuario){
        $query=$this->db->prepare('SELECT * FROM `login` WHERE usuario=?');
        $query->execute([$usuario]);

        $user=$query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}
<?php

class User {
    private $pdo;

    public function __construct($password, $username, $servername) {
        try {
            $this->pdo = new PDO("mysql:host=$servername;dbname=teste", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function register($name, $email, $password) {

        $sql = $this->pdo->prepare("SELECT usuario_id 
            							FROM usuario
            							WHERE usuario_email = '$email'");
        $sql->execute();
        if ($sql->rowCount() > 0) {
    
            return false;
        } else { // Email não encontrado
            $sql = $this->pdo->prepare("INSERT INTO usuario (usuario_nome,usuario_email,usuario_pass) 
                                         VALUES ('$name','$email','$password')");
            $sql->execute();
            return true;
        }
    }

    public function login($email, $password) {

        $data = [];
        $sql = $this->pdo->prepare("SELECT usuario_id, usuario_pass 
                                      FROM usuario
                                     WHERE usuario_email = '$email' AND usuario_pass = '$password'");
        $sql->execute();
        $data = $sql->fetch();
        if (isset($data['usuario_id']) && intval($data['usuario_id']) > 0) {
            return $data['usuario_id'];
        } else {
            return false;
        }
    }

    public function queryUsers() {
        $result = [];
        $sql = $this->pdo->query("SELECT * FROM usuario 
                                       ORDER BY usuario_id");
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function deleteUserByID($id) {
        $sql = $this->pdo->prepare("DELETE FROM usuario 
                                          WHERE usuario_id = '$id'");
        $sql->execute();
        return true;
    }

    public function updateUserById($id, $name, $password) {
        $sql = $this->pdo->prepare("UPDATE usuario 
                                    SET usuario_nome = '$name', usuario_pass = '$password' 
                                    WHERE usuario_id = '$id'");
        $sql->execute();
         return true;
    }

    public function findUserByEmail($email) {
        $data = [];
        $sql = $this->pdo->prepare("SELECT usuario_nome, usuario_email, usuario_id 
                                    FROM   usuario
                                    WHERE  usuario_email = '$email'");
        $sql->execute();
        $data = $sql->fetch();
        if (isset($data['usuario_id']) && intval($data['usuario_id']) > 0) {
            return $data;
        }
        else {
            return false;
        }
    }

}

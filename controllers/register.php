<?php

require '../model/Users.php';

$user = new User('', 'root', 'localhost');

if (isset($_POST['name'])) {

    $name         = addslashes($_POST['name']);
    $email        = addslashes($_POST['email']);
    $password     = addslashes($_POST['password']);
    $confPassword = addslashes($_POST['confPassword']);

    if (empty($name) || empty($email) || empty($password) || empty($confPassword)) {
        echo 'Preencha todos os campos';
          return false;
    }


    $nameFiltered         = filter_var($name, FILTER_SANITIZE_STRING);
    $passwordFiltered     = filter_var($password, FILTER_SANITIZE_STRING);
    $confPasswordFiltered = filter_var($confPassword, FILTER_SANITIZE_STRING);

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo 'Email não é válido';
        return false;
    }


    if ($passwordFiltered != $confPasswordFiltered) {
        echo 'Senhas não são iguais';
        return false;
    }

    if ($user->register($nameFiltered, $email, md5($passwordFiltered))) {
        echo 'Registrado com sucesso';
          return true;
    } 
    
    else {
        echo 'Email já cadastrado';
          return false;
    }
}

?>
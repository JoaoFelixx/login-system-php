<?php 

require '../model/Users.php';

$user = new User('','root','localhost');

if (isset($_POST['username'])) {

    $email    = addslashes($_POST['username']);
    $password = md5($_POST['password']);

    if (empty($email) || empty($password)) {
        echo 'Preencha todos os campos';
          return false;
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo 'Email não é válido';
        return false;
    }

    
    $data = $user->login($email,$password);
    if ($data) {
        header('location: ../');
        session_start();
        $_SESSION['id_user'] = $data;
          return true;
    }
    else {
        echo 'senha incorreta ou usuario não existe';
        return false;
    }

}

?>
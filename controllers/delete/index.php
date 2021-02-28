<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header('location: /teste/');
    exit();
}


$id_delete = addslashes($_GET['id']);

if (filter_var($id_delete, FILTER_VALIDATE_INT) === false) {
    echo 'ID inválido';
        return false;
}

require '../../model/Users.php';
$user = new User('','root', 'localhost');


if ($user->deleteUserByID($id_delete)) {
    echo 'deletado com sucesso';
        return true;
}
else {
    echo 'Erro ao deletar, tente novamente mais tarde';
}
?>
<?php
  require '../../model/Users.php';
  require '../../controllers/delete/index.php';

  session_start();

  if (!isset($_SESSION['id_user'])) {
    header('location: /teste/');
    exit();
  }

  $user = new User('','root', 'localhost');

  $id_delete = addslashes($_GET['id']);
 
  $errors = hasError($id_delete);

  if ($errors === false && $user->deleteUserByID($id_delete)) {
    $_SESSION['deleted'] = true;
    header('location: ../../');
    return;
  }

  $_SESSION['deleted'] = false;
  header('location: ../../');
?>
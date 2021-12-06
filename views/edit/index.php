<?php
  require '../../model/Users.php';
  require '../../controllers/edit/index.php';

  session_start();
  $user = new User('', 'root', 'localhost');

  if (!isset($_SESSION['id_user'])) {
    header('location: ../../');
    exit();
  }

  $_SESSION['id'] = addslashes($_GET['id']);

  if (isset($_POST['name'])) {
    try {
      $name           = addslashes(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
      $password       = addslashes(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
      $confPassword   = addslashes(filter_var($_POST['confPassword'], FILTER_SANITIZE_STRING));
      
      $errors = hasError($password, $confPassword);

      if ($errors != false) 
        echo "<div class='msg-erro'> $errors !</div>";    
      
      if ($errors === false && $user->updateUserById($_SESSION['id'], $name, $password)) {
        $_SESSION['updated'] = true;
        header('location: ../../index.php');
      }

    } catch (Exception $err) {
      echo $err->getMessage(); 
    }
  }

?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../../views/css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Atualizar - Sistema de login</title>

</head>

<body>
  <div class="container">
    <div class="div-center">
      <h2 style="text-align: center;"> Atualizar Cadastro </h2> <br>

      <form action="#" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">Nome</label>
          <input type="text" name="name" class="form-control" id="email" placeholder="Ex. Fulano">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Digite uma senha</label>
          <input type="password" name="password" class="form-control" id="email" placeholder="*********">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Confirme sua senha</label>
          <input type="password" name="confPassword" class="form-control" id="password" placeholder="*********">
        </div><br>
        <div class="flex-container">
          <button type="submit" class="btn btn-success btn-sm big-button">Cadastrar</button>
          <button type="reset" class="btn btn-danger btn-sm big-button">Cancelar</button>
        </div>
      </form><br>
    </div>
  </div>
</body>

</html>
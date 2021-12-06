<?php

  require '../../controllers/register/index.php';
  require '../../model/Users.php'; 
  
  $user = new User('', 'root', 'localhost');

  if (isset($_POST['name'])) {
    
    $name = addslashes($_POST['name']);
    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['password']);
    $confPassword = addslashes($_POST['confPassword']);

    $errors = hasErrors($name, $email, $password, $confPassword);
    
    if ($errors === false) {

      $user->register($name, $email, $password);
      
      session_start();
      $_SESSION['registered'] = true;
      header('location: ../login');
      exit();
    } 
    
    if ($errors != false) 
      echo "<div class='msg-erro'> $errors !</div>";

    if ($errors === false) 
      echo "<div class='msg-erro'>Email já cadastrado !</div>";
    
  }

?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
  <title>Register / Registro</title>

</head>

<body>
  <div class="container">
    <div class="div-center">
      <h2 style="text-align: center;"> Registre-se </h2> <br>

      <form action="#" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">Nome</label>
          <input type="text" name="name" class="form-control" id="email" placeholder="Ex. Fulano">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Digite seu e-mail</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
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
      <p class="click-here">Já tem uma conta ? <a href="../login">Clique aqui</a></p>
    </div>
  </div>
</body>

</html>
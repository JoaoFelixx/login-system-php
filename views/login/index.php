<?php

require '../../controllers/login/index.php';
require '../../model/Users.php';

$user = new User('', 'root', 'localhost');

session_start();

if ($_SESSION['registered'] === true) {
  echo "<div class='msg-sucesso'>Cadastrado com sucesso !</div>";
  $_SESSION['registered'] = null;
}

if (isset($_POST['email'])) {

  $email    = addslashes($_POST['email']);
  $password = addslashes($_POST['password']);

  $errors   = hasErrors($email, $password);

  if ($errors === false && $user->login($email, $password)) {
    header('location: ../../');
    exit();
  }
  
  if ($errors != false) 
    echo "<div class='msg-erro'>$errors !</div>";
  
  if ($errors === false)  
    echo "<div class='msg-erro'>Senha ou/e email incorreto(s)!</div>";
}

?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Login</title>

</head>

<body>
  <div class="container">
    <div class="div-center">
      <h2 style="text-align: center;"> Faça Login para entrar </h2> <br>

      <form action="#" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">Digite seu e-mail</label>
          <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Digite sua senha</label>
          <input name='password' type="password" class="form-control" id="password" placeholder="*********">
        </div><br>
        <div class="flex-container">
          <button type="submit" class="btn btn-success btn-sm big-button">Entrar</button>
          <button type="reset" class="btn btn-danger btn-sm big-button">Cancelar</button>
        </div>
      </form><br>
      <p class="click-here">Não tem uma conta ? <a href="../register">Clique aqui</a></p>
    </div>
  </div>
</body>

</html>
<?php

session_start();
if (!isset($_SESSION['id_user'])) {
  header('location: ../../');
  exit();
}

$_SESSION['id'] = addslashes($_GET['id']);

?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../../views/css/style.css">
  <title>Edit / Register</title>
</head>

<body>
  <div>
    <form action="#" method="POST">
      <h1>Atualizar cadastro</h1>
      <label for="">Nome</label> <br>
      <input name="name" type="text"><br>
      <label for="">Senha</label> <br>
      <input name="password" type="password"><br>
      <label for="">Confirmação de senha</label> <br>
      <input name="confPass" type="password"><br>
      <br>
      <button type="submit" class="btn btn-primary">Atualizar conta</button>
    </form>
  </div>
</body>

</html>


<?php

if (!isset($_POST['name'])) {
  return false;
}

$name           = addslashes(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
$password       = addslashes(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
$confPassword   = addslashes(filter_var($_POST['confPass'], FILTER_SANITIZE_STRING));

if (filter_var($_SESSION['id'], FILTER_VALIDATE_INT) === false) {
  echo 'ID inválido';
  return false;
}

if ($password != $confPassword) {
  echo 'Senhas não são iguais';
  return false;
}

echo $_SESSION['id'];

require '../../model/Users.php';
$user = new User('', 'root', 'localhost');

if ($user->updateUserById($_SESSION['id'], $name, md5($password))) {
  echo '<script>';
  echo 'alert("Atualizado com sucesso")';
  echo '</script>';
  return true;
} else {
  return false;
}

?>
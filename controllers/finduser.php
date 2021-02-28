<?php

$email = addslashes($_POST['email']);

if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  echo 'Email inválido';
  return false;
}

require '../model/Users.php';

$user = new User('', 'root', 'localhost');
$data = [];
$data = $user->findUserByEmail($email);
if (!$data) {
  echo 'Email não consta em nosso banco de dados';
  return false;
}

global $data;
?>


<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>ID: <?php echo $data['usuario_id']; ?></title>
</head>
<style>
  .center {
    position: relative;
    top: 100px;
    width: 400px;
    background-color: rgb(9, 253, 253);
    padding: 10px;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
  }
</style>

<body>
  <div class="center">
    <h3>ID: <?php echo $data['usuario_id'] ?></h3>
    <h5>Nome: <?php echo $data['usuario_nome'] ?> </h5>
    <h5>Email: <?php echo $data['usuario_email'] ?> </h5>
    <a class="white" href="../controllers/edit/index.php?id= <?php echo $data['usuario_id']; ?>"><button class="btn btn-primary"> Editar </button></a>
    <a class="white" href="../controllers/delete/index.php?id=<?php echo $data['usuario_id']; ?>"><button class="btn btn-danger"> Excluir </button></a>
  </div>

</body>

</html>
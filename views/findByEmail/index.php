<?php

  require '../../controllers/find/index.php';
  require '../../model/Users.php';

  $data = (array) [];
  $email = (string) addslashes($_GET['email']);

  $error = hasError($email);

  if ($error != false) 
    echo "<div class='msg-erro'>$error !</div>";

  if ($error === false) {
    $user = new User('', 'root', 'localhost');
    $data = $user->findUserByEmail($email);
    if (!$data) 
      echo "<div class='msg-erro'>Email não consta em nosso banco de dados</div>";   
  }
  global $data;

?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>ID: <?php echo $data['ID']; ?></title>
</head>
<style>

</style>

<body>
  <?php 
    if ($data) {

  ?> 
  <div class="center">
    <h3>ID: <?php echo $data['ID'] ?></h3>
    <h5>Nome: <?php echo $data['nm_name'] ?> </h5>
    <h5>Email: <?php echo $data['em_email'] ?> </h5>
    <a class="white" href="../../controllers/edit/index.php?id= <?php echo $data['ID']; ?>"><button class="btn btn-primary"> Editar </button></a>
    <a class="white" href="../../controllers/delete/index.php?id=<?php echo $data['ID']; ?>"><button class="btn btn-danger"> Excluir </button></a>
  </div>
  <?php      
    } 
  ?> 
</body>

</html>
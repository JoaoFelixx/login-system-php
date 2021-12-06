<?php
  require 'model/Users.php';

  session_start();

  if (!isset($_SESSION['id_user'])) {
    header('location: views/login');
    exit();
  }

  $user = new User('', 'root', 'localhost');

  $data = $user->queryUsers();
  global $data;

?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/query.css">
  <title>Consulta</title>
</head>
<style>
  .grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    grid-gap: 25px 25px;

  }

  .grid-item {
    box-shadow: 5px 10px 8px 10px #888888;
    text-align: center;
    padding: 5px;
  }

  .white {
    text-decoration: none;
    color: white;
  }

  div.msg-erro {
    width: 400px;
    position: relative;
    top: 10px;
    margin-left: auto;
    font-size: 18px;
    text-align: center;
    padding: 14px;
    margin-right: auto;
    background-color: rgba(250, 128, 114, 0.3);
    border: 1px solid rgb(165, 42, 42);
    color: #ffffff;
  }

  div.msg-sucesso {
    width: 400px;
    margin: 10px auto;
    padding: 10px;
    position: flex;
    top: 50px;
    left: -35px;
    text-align: center;
    background-color: rgba(0, 255, 21, 0.781);
    border: 1px solid rgb(9, 255, 0);
    color: #ffffff;
  }

  @media screen and (max-width: 660px) {
    .grid {
      grid-template-columns: 1fr 1fr;
    }
  }

  @media screen and (max-width: 415px) {
    .grid {
      grid-template-columns: 1fr;
    }
  }
</style>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Sistema de Login</a>
      <form class="d-flex" method="GET" action="./views/findByEmail">
        <input name="email" class="form-control me-2" type="search" placeholder="Buscar por email" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
    </div>
  </nav>
  <?php 

    if ($_SESSION['updated'] === true) {
      echo "<div class='msg-sucesso'>Cadastrado atualizado com sucesso !</div>";
      $_SESSION['updated'] = null;
    }

    if ($_SESSION['updated'] === false) {
      echo "<div class='msg-erro'> Erro ao atualizar, Tente novamente !</div>";
      $_SESSION['updated'] = null;
    }

    if ($_SESSION['deleted'] === true) {
      echo "<div class='msg-sucesso'>Usuario deletado sucesso !</div>";
      $_SESSION['deleted'] = null;
    }

    if ($_SESSION['deleted'] === false) {
      echo "<div class='msg-erro'> Erro ao deletar, Tente novamente !</div>";
      $_SESSION['deleted'] = null;
    }

  ?>
  <div class="mt-5 grid">
    <?php

    for ($index = 0; $index < count($data); $index++) {
    ?>
      
      <div class="grid-item">
        <h3>ID: <?php echo $data[$index]['ID'] ?></h3>
        <h5>Nome: <?php echo $data[$index]['nm_name'] ?> </h5>
        <h5>Email: <?php echo $data[$index]['em_email'] ?> </h5>
        <a class="white" href="./views/edit/index.php?id=<?php echo $data[$index]['ID']; ?>"><button class="btn btn-primary"> Editar </button></a>
        <a class="white" href="./views/delete/index.php?id=<?php echo $data[$index]['ID']; ?>"><button class="btn btn-danger"> Excluir </button></a>
      </div>

    <?php
    }
    ?>
  </div>
  <script src="../js/script.js"></script>
</body>

</html>
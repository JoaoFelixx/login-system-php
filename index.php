<?php 
session_start();

if (!isset($_SESSION['id_user'])){
  header('location: views/login');
  exit();
}
require 'model/Users.php';
$user = new User('', 'root', 'localhost');

$data = $user->queryUsers();
global $data;

?>


<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
  <a class="navbar-brand" href="#">Sistema de cadastro</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto"></ul>
    <form class="form-inline my-2 my-lg-0" method="POST" action="controllers/finduser.php">
      <input class="form-control mr-sm-2"  name="email" type="search" placeholder="Procurar usuario (email)" aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Pesquisar</button>
    </form>
  </div>
</nav>

<div class="mt-5 grid">
<?php 
  for ($index = 0; $index < count($data); $index++) {
?>

<div class="grid-item">
    <h3>ID: <?php echo $data[$index]['usuario_id'] ?></h3>
    <h5>Nome: <?php echo $data[$index]['usuario_nome'] ?> </h5>
    <h5>Email: <?php echo $data[$index]['usuario_email'] ?> </h5>
  <a class="white" href="controllers/edit/index.php?id=<?php echo $data[$index]['usuario_id']; ?>"><button class="btn btn-primary"> Editar </button></a>
  <a class="white" href="controllers/delete/index.php?id=<?php echo $data[$index]['usuario_id']; ?>"><button class="btn btn-danger"> Excluir </button></a> 
</div>

<?php
  }
?>
</div>
  <script src="../js/script.js"></script>
</body>

</html>
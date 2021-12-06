<?php

function hasError(string $password, string $confPassword) {
  if (filter_var($_SESSION['id'], FILTER_VALIDATE_INT) === false) 
    return 'ID inválido';
  
  if (strlen($password) < 4)
    return 'Senha muito fraca';

  if ($password != $confPassword) 
    return  'Senhas não são iguais';
  
  return false;
}


?>
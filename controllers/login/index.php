<?php

function hasErrors (string $email, string $password): string | bool {
  if (empty($email) || empty($password)) return 'Preencha todos os campos';
  
  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) return 'Email não é válido';

  if (strlen($password) < 4) return 'Senha muito curta';

  return false;
}

?>
<?php

function hasError(string $email) : bool | string {
  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
    return 'Email inválido';
  
  return false;
}

?>
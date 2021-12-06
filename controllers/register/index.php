<?php
	
	function hasErrors(string $name, string $email, string $password, string $confPassword ): string | bool {

		if (empty($name) || empty($email) || empty($password) || empty($confPassword)) 
			return 'Preencha todos os campos';
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)  return 'Email não é válido';

		if ($password != $confPassword) return 'Senhas não são iguais';
		
		return false;
	}

?>
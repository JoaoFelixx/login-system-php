<?php

function hasError(int $id): string | bool {
  if (filter_var($id, FILTER_VALIDATE_INT) === false) 
    return 'ID inválido';

	return false;
}

?>
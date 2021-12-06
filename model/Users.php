<?php

class User { 
	private $pdo;

	private $SQL_CREATE_COMMAND = "INSERT INTO users (nm_name, em_email, cd_password) VALUES (?,?,?)";
	private $SQL_DELETE_USER_BY_ID = "DELETE FROM users WHERE ID = :id";
	private $SQL_UPDATE_USER_BY_ID = "UPDATE users SET nm_name = :nm, cd_password = :p WHERE ID = :id";
	private $SQL_SELECT_EMAIL_COMMAND = "SELECT ID FROM users WHERE em_email = :e";
	private $SQL_GET_ALL_DATA_BY_EMAIL = "SELECT nm_name, em_email, ID  FROM users WHERE  em_email = :e";
	private $SQL_SELECT_DATA_BY_EMAIL = "SELECT ID, cd_password FROM users WHERE em_email = :e";
	private $SQL_GET_ALL_USERS_ORDER_BY_USER_ID = "SELECT * FROM users ORDER BY ID";


	public function __construct($password, $username, $serverName) {
		try {
			$this->pdo = new PDO("mysql:host=$serverName;dbname=system_login", $username, $password);
		
		} catch (PDOException $err) {
			echo "Connection failed: " . $err->getMessage();
			exit();

		} catch (Exception $err) {
			echo 'Error: '.$err->getMessage();
			exit();
		}
	}

	public function register(string $name, string $email, string $password) : bool {
		try {
			$sql = $this->pdo->prepare($this->SQL_SELECT_EMAIL_COMMAND);
			$sql->bindValue(':e', $email);
			$sql->execute();

			if ($sql->rowCount() > 0) 
			return false;

			$sql = $this->pdo->prepare($this->SQL_CREATE_COMMAND);
			$sql->bindParam(1, $name);
			$sql->bindParam(2, $email);
			$sql->bindParam(3, password_hash($password, PASSWORD_DEFAULT));
			$sql->execute();

			return true;
		} catch (Exception $err) {
			echo $err->getMessage();
			exit();
		}
	}

	public function login(string $email, string $password): bool {
		try {
			$data = (array) [];
		
			$sql = $this->pdo->prepare($this->SQL_SELECT_DATA_BY_EMAIL);
			$sql->bindValue(':e',$email);
			$sql->execute();
			$data = $sql->fetch();

			$hash = $data['cd_password'];

			if (password_verify($password, $hash)) {
				session_start();
				$_SESSION['id_user'] = $data['ID'];
				return true;
			} else {
				return false;
			}
							
		} catch (Exception $err) {
			echo $err->getMessage();
			exit();
		}
	}

	public function queryUsers(): array {
		try {
			$result = (array) [];
			$sql = $this->pdo->query($this->SQL_GET_ALL_USERS_ORDER_BY_USER_ID);
			$result = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $result;
			
		} catch (Exception $err) {
			echo $err->getMessage();
			exit();
		}
	}

	public function deleteUserByID(int $id): bool {
		try {
			$sql = $this->pdo->prepare($this->SQL_DELETE_USER_BY_ID);
			$sql->bindValue(':id', $id);
			$sql->execute();
			return true;

		} catch (Exception $err) {
			echo $err->getMessage();
			exit();
		}
	}

	public function updateUserById(int $id, string $name, string $password): bool {
		try {
			$sql = $this->pdo->prepare($this->SQL_UPDATE_USER_BY_ID);
			$sql->bindValue(':id',$id);
			$sql->bindValue(':nm',$name);
			$sql->bindValue(':p',password_hash($password, PASSWORD_DEFAULT));																		
			$sql->execute();

			return true;
		} catch (Exception $err) {
			echo $err->getMessage();
			exit();
		}      
	}

	public function findUserByEmail(string $email): array | bool {
		try {
			$data = (array) [];
			
			$sql = $this->pdo->prepare($this->SQL_GET_ALL_DATA_BY_EMAIL);
			$sql->bindValue(':e', $email);																		
			$sql->execute();

			$data = $sql->fetch();

			if (isset($data['ID']) && intval($data['ID']) > 0) 
				return $data;

			return false;
			
		} catch (Exception $err) {
			echo $err->getMessage();
			exit();
		}    
	}
}
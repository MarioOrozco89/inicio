<?php

class Usuarios{
	
	public static function login($password,$user){
		
		$query = "SELECT * from usuarios where usuario = ? and password = ?";
		$connection = Connection::connect();
		$stmt = $connection->prepare($query);
		$stmt->execute(array(
			$user,
			$password
		));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$success = $stmt->rowCount();
		Connection::disconnect($connection);
		if($result['status']=="activo"){
			return "El usuario si puede entrar";
		}
		else
		{
			return "El usuario no puede entrar";
		}
		//return $result;

	}
}

?>
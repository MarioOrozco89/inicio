<?php
class Users{
	
	private static $campus = "campus";
	private static $employees_access_permission = "employees_access_permission";
	
	public static function login($password,$user){
		$response = array();
		switch (true) {
			case (strlen($user) === 10 && substr($user, 0,2) === "IT"):
				$users = "students";
				$job_title = "Alumno";
			break;
			case (strlen($user) === 10 && substr($user, 0,2) === "MA"):
				$users = "teachers";
				$job_title = "Maestro";
				//return "Es maestro";
			break;
			case (strlen($user) === 8 && substr($user, 0,2) === "TU"):
				$users = "guardians";
				$job_title = "Tutor";
				//return "Es tutor";
			break;
			case (filter_var($user, FILTER_VALIDATE_EMAIL)!=false):
				$users = "employees";
			break;
			default:
				$response['status'] = "2";
				$response['message'] = "Usuario no reconocido";
				$response['data'] = array();
				return $response;
				break;
		}
		if($users!="employees"){
			$query = "SELECT u.id, u.names, u.middle_name, u.last_name, u.campus, c.name as campus_name from ".$users." u JOIN ".self::$campus." c ON u.campus = c.id where u.code = ? and u.password = ?";
		}
		else{
			$query = "SELECT u.id, u.names, u.hybrid, u.job_title, u.middle_name, u.last_name, u.campus, c.name as campus_name from ".$users." u JOIN ".self::$campus." c ON u.campus = c.id where u.email = ? and u.password = ?";			
		}
		
		$connection = Connection::connect();
		$stmt = $connection->prepare($query);
		$stmt->execute(array(
			$user,
			sha1($password)
		));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$success = $stmt->rowCount();
		
		if($success == 1){
			$stmt = null;
			if($users == "employees"){
				$job_title = $result['job_title'];
				$users = "admin";
			}
			$result['user_type'] = $users;
			$result['job_title'] = $job_title;

			$response['status'] = "1";
			$response['message'] = "Usuario encontrado";
            $response['data'] = $result;	
		}
		else{
			$response['status'] = "0";
			$response['message'] = "Usuario o contraseña inválidos";
            $response['data'] = array();
		}
		$stmt = null;
		$query = "";
		if($users!="employees"){
			$query = "SELECT access,permission from ".self::$employees_access_permission." where employee_id = ?";
			$stmt = $connection->prepare($query);
			$stmt->execute(array(
				$result['id']
			));
			$access_permission = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$response['data']['access_permission'] = $access_permission;
		}
		Connection::disconnect($connection);
		return $response;
	}
	public static function editPass($params){

		if($params['user_type']=='admin'){
			$params['user_type']='employees';
		}
        $query="UPDATE ".$params['user_type']." SET password=? where id=?";
        $connection = Connection::connect();
		$stmt = $connection->prepare($query);
		$stmt->execute(array(
            sha1($params["password"]),
            $params["id"]
        ));
        $success = $stmt->rowCount();
        $stmt = null;
		Connection::disconnect($connection);
		if($success>0){
			$response['status'] = "1";
			$response['message'] = "Se modificó el registro";
			$response['data'] = $success;
		}
		else{
			$response['status'] = "0";
			$response['message'] = "Error al modificar el registro";
			$response['data'] = [];
		}
		return $response;
    }
}
?>
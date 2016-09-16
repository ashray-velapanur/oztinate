<?php
class Teacher{

	function addTeacher($data) {
		$data["userType"] = 3;
		$user = new User();
		$status = $user->addUser($data);
		error_log($status);
	}

	function assignTeacher($teacherid, $studentid) {
		$query = "INSERT INTO teachers (teacherid, studentid) VALUES (".$teacherid.", ".$studentid.")";		
		$result = mysql_query($query)or die(mysql_error());
		if($result) 
			return true;
		else
			return false;
	}
}
?>
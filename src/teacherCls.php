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

	function getStudents($teacherid) {
		$query = "SELECT username FROM teachers INNER JOIN users ON teachers.studentid = users.userid WHERE teacherid=".$teacherid;
		error_log($query);
		$result = mysql_query($query)or die(mysql_error());
		if($result) {
			$students = array();
			while ($row = mysql_fetch_assoc($result)) {
	       		array_push($students, $row['username']);
	        }
	        return $students;
		} else {
			return false;
		}
	}

}
?>
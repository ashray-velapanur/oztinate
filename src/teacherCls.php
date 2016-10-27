<?php
class Teacher{

	function addTeacher($data) {
		$data["userType"] = 3;
		$data["userName"] = $_POST["email"];
		$user = new User();
		$status = $user->addUser($data);
		error_log($status);
	}

	function deleteTeacher($studentid) {
		$query = "DELETE FROM teachers WHERE studentid=".$studentid;
		$result = mysql_query($query)or die(mysql_error());
		if($result) {
	        return true;
		} else {
			return false;
		}		
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
		$query = "SELECT username, userid FROM teachers INNER JOIN users ON teachers.studentid = users.userid WHERE teacherid=".$teacherid;
		error_log($query);
		$result = mysql_query($query)or die(mysql_error());
		if($result) {
			$students = array();
			while ($row = mysql_fetch_assoc($result)) {
				$assignedTask = new AssignedTask();
				$unreviewdCount = $assignedTask->getAssignedTaskCount($row["userid"], 3);
				$student = array("username"=>$row["username"], "userid"=>$row["userid"], "unreviewdCount"=>$unreviewdCount);
	       		array_push($students, $student);
	        }
	        return $students;
		} else {
			return false;
		}
	}

}
?>
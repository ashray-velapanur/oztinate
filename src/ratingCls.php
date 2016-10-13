<?php
class Rating{

	function rate($assignedTaskId, $rating) {
		$query = "INSERT INTO ratings (assignedTaskId, rating) VALUES (".$assignedTaskId.", ".$rating.")";		
		$result = mysql_query($query)or die(mysql_error());
		if($result) 
			return true;
		else
			return false;
	}

}
?>
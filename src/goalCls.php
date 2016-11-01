<?php
class Goal{

	public static function createGoal($tagId, $duration, $rating, $userId) {
		$query = "INSERT INTO goal (tagid, duration, rating, userid) VALUES (".$tagId.", ".$duration.", ".$rating.", ".$userId.")";
		$result = mysql_query($query) or die(mysql_error());
		if($result) 
			return true;
		else
			return false;

	}
}
?>
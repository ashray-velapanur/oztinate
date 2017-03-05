<?php
class Goal{

	public static function createGoal($exerciseId, $duration, $rating, $userId) {
		$query = "INSERT INTO goal (exerciseId, duration, rating, userid) VALUES (".$exerciseId.", ".$duration.", ".$rating.", ".$userId.")";
		$result = mysql_query($query) or die(mysql_error());
		if($result) 
			return true;
		else
			return false;
	}

	public static function getProgress($userId) {
		$query = "SELECT * FROM goal WHERE userid = ".$userId;
		$result = mysql_query($query) or die(mysql_error());

		$goals = array();
		while ($row = mysql_fetch_assoc($result)) {
			$tagId = $row["tagid"];
			$targetDuration = $row["duration"];
			$rating = $row["rating"];

			$tagDetails = Tag::getTagDetails($tagId);
			$tasks = Tag::getAssignedTasksWithTag($tagId);
			
			$totalDuration = 0;
			foreach ($tasks as $task) {
				$totalDuration = $totalDuration + $task["duration"];
			}
			$progress = ($totalDuration/$targetDuration) >= 1.0 ? 1.0 : $totalDuration/$targetDuration;
			$progress = $progress * 100.0;
			array_push($goals, array("tagId"=>$tagId, "totalDuration"=>$totalDuration, "targetDuration"=>$targetDuration, "rating"=>$rating, "progress"=>$progress, "name"=>$tagDetails["name"]));
        }
        return $goals;

	}
}
?>
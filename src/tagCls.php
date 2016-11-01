<?php
class Tag{

	public static function getOrCreateTag($name) {
		$query = mysql_query("SELECT id FROM tag WHERE name='".$name."'");
		$result = mysql_fetch_assoc($query);
		if ($result) {
			return $result["id"];
		} else {
			$query = mysql_query("INSERT INTO tag (name) VALUES ('".$name."')");
			if($result) 
				return mysql_insert_id();
			else
				return false;
		}
	}

	public static function assignTag($tagId, $taskId) {
		$query = "INSERT INTO assignedtag (tagid, taskid) VALUES (".$tagId.", ".$taskId.")";
		$result = mysql_query($query) or die(mysql_error());
		if($result) 
			return true;
		else
			return false;

	}
}
?>
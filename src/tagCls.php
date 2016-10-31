<?php
class Tag{

	public static function createTag($name) {
		$query = "INSERT INTO tag (name) VALUES ('".$name."')";
		$result = mysql_query($query)or die(mysql_error());
		if($result) 
			return true;
		else
			return false;
	}
}
?>
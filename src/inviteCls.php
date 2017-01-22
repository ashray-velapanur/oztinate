<?php
class Invite{

	public static function createInvite($email, $userId) {
		$queryString = "INSERT INTO invite (email, userId) VALUES ('".$email."', ".$userId.")";
		error_log($queryString);
		$result = mysql_query($queryString) or die(mysql_error());
		if($result) 
			return true;
		else
			return false;
	}

	public static function getInviteById($id)
	{
		$result = mysql_query("select * from invite where id=".$id);
		if(mysql_num_rows($result))
		{
			return mysql_fetch_array($result);
		} else {
			return false;
		}		
	}
}
?>
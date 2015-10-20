<?php
Class Tab{
	function getAllTabs(){
		$query = "SELECT tabId,name,tabUrl,createdDate FROM tablature";
			$result = mysql_query($query);
		if($result)
		{
			return $result;
		}
		else
		 return array("status"=>"Error","message"=>"Query Error");	
	}
	
	function addTab($data,$files){
	
		if($this->checkTabExist($data["tabName"])=="true")
		{
			return "Exist";
		}
		
		$basePath=$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']) . '/'; 
		
		//echo  dirname($_SERVER["REQUEST_URI"]);  echo $_SERVER["DOCUMENT_ROOT"]; 
		
		$query = "INSERT INTO tablature (name,updatedId,createdDate) values('".$data["tabName"]."',NOW(),NOW())"; 
		$result = mysql_query($query) or die(mysql_error());
		$id = mysql_insert_id();
		if($result)
		{
			$imageFileType = pathinfo($files["tabFile"]["name"],PATHINFO_EXTENSION);
			$fileName = "tab_".$id.".".$imageFileType;
			$file_url = "http://".$basePath."uploads/tabs/".$fileName;
			$target_file = $_SERVER["DOCUMENT_ROOT"]."/oztinate/uploads/tabs/".$fileName;
			
			move_uploaded_file($files["tabFile"]["tmp_name"], $target_file);
			$query = "UPDATE tablature SET tabUrl='".$file_url."' WHERE tabId=".$id;
			$result = mysql_query($query);
			return "Success";
		}	
		else
			return "Error";
	}
	
	function deleteTab($id)
	{
		$result=mysql_fetch_array(mysql_query("select count(*) as count from tasktablatures where tablatureId=".$id));
		if(!$result["count"])
		{	
				if(mysql_query("delete from tablature where tabId=".$id) or die(mysql_error()))
				{
					return "1";
				}
				else
					return "2";
		}
		else
			return "3";
			
	}
	
	function checkTabExist($tabName)
	{
		$result=mysql_fetch_array(mysql_query("select count(*) as count from tablature where name='".$tabName."'"));
		if($result["count"])
		{	
			return "true";
		}
		else{
			return "false";
		}
		
	}
}
?>
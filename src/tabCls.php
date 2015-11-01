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
	
	function uploadTablature($tabId)
	{
		$uploads_dir = 'uploads/tabs';
		//var_dump($_FILES); die;
		if (!$_FILES["fileUpload"]["error"]) {
			$tmp_name = $_FILES["fileUpload"]["tmp_name"];
			$name = $_FILES["fileUpload"]["name"];
			//$id = explode(".",$name);
			$fileUrl = "http://".$_SERVER['HTTP_HOST']."/oztinate/uploads/tabs/".$name;
			move_uploaded_file($tmp_name, "$uploads_dir/$name");
			$result = mysql_query("select tabId from tablature where tabId='".$tabId."'");
			if(!mysql_num_rows($result))
				return array("status"=>"Error","tabId"=>$tabId,"errorMessage"=>"Invalid clip Id. Please check your Clip Id");
			
			//$asstaskId = mysql_fetch_array($result);
			//$asstaskId = $asstaskId["assignedTaskId"];
			
			$query = "update tablature set tabUrl='$fileUrl' where tabId=".$tabId;
			if(!mysql_query($query))
			{
				return array("status"=>"Error","tabId"=>$tabId,"errorMessage"=>"Details update error.Please check file name");
			}
			else{
			
				return array("status"=>"Success","tabId"=>$tabId,"errorMessage"=>"");
			}	
		}
		else{
				return array("status"=>"Error","tabId"=>$tabId,"errorMessage"=>"File upload error. please upload again");
			}	
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
	
	//function checkTabExistForTask($tabName,)
}
?>
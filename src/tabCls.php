<?php
Class Tab{

	function getAllTabs($limitFrom=-1,$limitTo=-1,$search=null){

		$queryString="";
		$orderString="ORDER BY createdDate DESC";
		if(isset($search))
		{	
			$flag=false;
			//$queryString = "where";
			if(isset($search["name"])&&$search["name"]!="")
			{
				$queryString="Where tablature.name LIKE '%".$search["name"]."%'";
				$flag=true;
			}

			if((isset($search["dateFrom"])&& $search["dateFrom"]!="")&&(isset($search["dateTo"])&& $search["dateTo"]!=""))
			{
				if($queryString=="")
					$queryString="WHERE ";
				else
					$queryString.=" AND ";

				$dateFrom = strtotime($search["dateFrom"]);
				$dateFrom = date('Y-m-d',$dateFrom);

				$dateTo = strtotime($search["dateTo"]);
				$dateTo = date('Y-m-d',$dateTo);
				
				$queryString.="tablature
.createdDate BETWEEN '".$dateFrom."' AND '".$dateTo."'";
				
			}else if((isset($search["dateFrom"])&& $search["dateFrom"]!="")){

				if($queryString=="")
					$queryString="WHERE ";
				else
					$queryString.=" AND ";

				$dateFrom = strtotime($search["dateFrom"]);
				$dateFrom = date('Y-m-d',$dateFrom);
				$queryString.="tablature
.createdDate > '".$dateFrom."'";

			}else if((isset($search["dateTo"])&& $search["dateTo"]!="")){
				
				if($queryString=="")
					$queryString="WHERE ";
				else
					$queryString.=" AND ";

				$dateTo = strtotime($search["dateTo"]);
				$dateTo = date('Y-m-d',$dateTo);
				$queryString.="tablature
.createdDate < '".$dateTo."'";

			}


			if(isset($search["sort"])&& $search["sort"]!="")
			{
				if(isset($search["sortmode"])&&$search["sortmode"]=="AS")
				{
					$orderString = "ORDER BY ".$search["sort"]. " ASC";
				}
				else if(isset($search["sortmode"])&&$search["sortmode"]=="DS")				{
					$orderString = "ORDER BY ".$search["sort"]. " DESC";
				}
			}



		}

		if($limitFrom==-1||$limitTo==-1)
			$limit="";
		else
			$limit = "LIMIT ".$limitFrom.",".$limitTo;

		$query = "SELECT tabId,name,tabUrl,users.userName as createdUser,tablature.createdDate FROM tablature LEFT JOIN users ON tablature.createdUser=users.userId ".$queryString." ".$orderString." ".$limit;
			$result = mysql_query($query);
		if($result)
		{
			return $result;
		}
		else
		 return array("status"=>"Error","message"=>"Query Error");	
	}

	function getRecordCount($search=null)
	{
		$queryString="";
		
		if(isset($search))
		{	
			$flag=false;
			//$queryString = "where";
			if(isset($search["name"])&&$search["name"]!="")
			{
				$queryString="WHERE tablature.name LIKE '%".$search["name"]."%'";
				$flag=true;
			}

			

		}

		$query ="SELECT count(*) as total_count FROM tablature ".$queryString;
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
	
	function getDetails($tabId)
	{
		$query = "SELECT tabId,name,tabUrl,createdDate FROM tablature WHERE tabId=".$tabId;
			$result = mysql_query($query);
		if($result)
		{
			return mysql_fetch_array($result);
		}
		else
		 return array("status"=>"Error","message"=>"Query Error");	
	}

	function editTab($data)
	{
		if($this->checkTabExist($data["tabName"])=="true")
		{
			return array("status"=>"Error","message"=>"Error...!!! Tablature is already exist");
		}

		$query = "UPDATE tablature SET name='".$data["tabName"]."', updatedId=NOW() WHERE tabId=".$data["txtTabId"];
		if(mysql_query($query))
		{

			$query = "UPDATE assignedtask SET updatedId=NOW() WHERE Id IN(SELECT Id FROM(SELECT asstask.id FROM `assignedtask` as asstask JOIN task ON asstask.taskId=task.taskId JOIN tasktablatures as tasktab ON tasktab.taskId=task.taskId JOIN tablature ON tablature.tabId = tasktab.tablatureId WHERE tablature.tabId=".$data["txtTabId"].") as sub )";	
			mysql_query($query);
			return array("status"=>"Success","message"=>"Details Updated");
		}
		else
			 return array("status"=>"Error","message"=>"Query Error..  Details not updated");
	}

	function addTab($data,$files){
	
		if($this->checkTabExist($data["tabName"])=="true")
		{
			return array("status"=>"Error","message"=>"Error...!!! Tablature is already exist");
		}

		$imagesizedata = getimagesize($files["tabFile"]["tmp_name"]);
		//echo filesize($files["tabFile"]["tmp_name"]); die;
		//var_dump($imagesizedata); die();
		if(!$imagesizedata)
		{
			return array("status"=>"Error","message"=>"Error...!!! Uploaded file is not an images");
			
		}

		if(filesize($files["tabFile"]["tmp_name"])>201000)
		{
			return array("status"=>"Error","message"=>"Error...!!! Uploaded file exceed maximum allowed size(Max:200KB)");
		}

		$basePath=$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']) . '/'; 
		
		//echo  dirname($_SERVER["REQUEST_URI"]);  echo $_SERVER["DOCUMENT_ROOT"]; 
		
		$query = "INSERT INTO tablature (name,updatedId,createdUser,createdDate) values('".$data["tabName"]."',NOW(),".$_SESSION["userId"].",NOW())"; 
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
			return array("status"=>"Success","message"=>"New Tablature Added Successfully..!!!");
		}	
		else
			return array("status"=>"Error","message"=>"Error...!!! Tablature is not added");
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
	
	/*function uploadTablature($tabId)
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
				return array("status"=>"Error","tabId"=>$tabId,message=>"Invalid clip Id. Please check your Clip Id");
			
			//$asstaskId = mysql_fetch_array($result);
			//$asstaskId = $asstaskId["assignedTaskId"];
			
			$query = "update tablature set tabUrl='$fileUrl' where tabId=".$tabId;
			if(!mysql_query($query))
			{
				return array("status"=>"Error","tabId"=>$tabId,message=>"Details update error.Please check file name");
			}
			else{
			
				return array("status"=>"Success","tabId"=>$tabId,message=>"");
			}	
		}
		else{
				return array("status"=>"Error","tabId"=>$tabId,message=>"File upload error. please upload again");
			}	
	}*/
	
	function uploadTablature()
	{
		$uploads_dir = 'uploads/tabs';
		//var_dump($_FILES); die;
		/*foreach($_FILES as $file){
			var_dump($file); 
		}die;*/
		$flag=false;
		$log = fopen("tabupload_log.txt", "w");
		fwrite($log,json_encode($_FILES));
		$response = array();
		foreach($_FILES as $file){
			if (!$file["error"]) {
				$tabId = explode('.',$file["name"]);
				$tabId=$tabId[0];
				$tmp_name = $file["tmp_name"];
				$name = $file["name"];
				//$id = explode(".",$name);
				$fileUrl = "http://".$_SERVER['HTTP_HOST']."/oztinate/uploads/tabs/".$name;
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
				$result = mysql_query("select tabId from tablature where tabId='".$tabId."'");
				if(mysql_num_rows($result)<=0){
					array_push($response,array("status"=>"Error","tabId"=>$tabId,message=>"Invalid clip Id. Please check your Clip Id"));
					continue;	
				}
				//$asstaskId = mysql_fetch_array($result);
				//$asstaskId = $asstaskId["assignedTaskId"];
				
				$query = "update tablature set tabUrl='$fileUrl' where tabId=".$tabId;
				if(!mysql_query($query))
				{
					array_push($response,array("status"=>"Error","tabId"=>$tabId,message=>"Details update error.Please check file name"));
				}
				else{
					$flag=true;
					array_push($response,array("status"=>"Success","tabId"=>$tabId,"tabUrl"=>$fileUrl,message=>""));
				}	
			}
			else{
					array_push($response,array("status"=>"Error","tabId"=>$tabId,message=>"File upload error. please upload again"));
				}
		}
			if($flag)
				return array("status"=>"Success","uploadedTabs"=>$response);
			else
				return array("status"=>"Error","uploadedTabs"=>$response);
			//return $response;
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
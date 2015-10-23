<?php
class AssignedTask{

	function assignTask($data,$createdByUser){
		if(!isset($data["createdUserId"]))
			$data["createdUserId"] = $_SESSION["userId"];
			
		if(!isset($data["dateOfAssign"]))
			$data["dateOfAssign"] = date('Y-m-d H:i:s');
			
		if(!isset($data["updatedId"]))
			$data["updatedId"] = date('Y-m-d H:i:s');
		
		if(!isset($data["userId"]))
			$data["userId"] = $data["createdUserId"];
			
		if(!isset($data["status"]))	
			$data["status"]=0;
		else{
			if($data["status"]==2) $data["status"]=3;
		}
		
		$time = strtotime($data["dateOfCompletion"]);
		$newformat = date('Y-m-d',$time);	
		
		$query="INSERT INTO assignedtask (taskId,userId,status,createdUserId,assignedDate,completionDate,isCreatedByUser,updatedId,createdDate) values(".$data["taskId"].",".$data["userId"].",".$data["status"].",".$data["createdUserId"].",'".$data["dateOfAssign"]."','".$newformat."','".$createdByUser."','".$data["updatedId"]."',NOW())";
		//die; 
		
		if(mysql_query($query)) 
			return "Success";
		else
			return "Error";
		
	}
	
	function uploadSoundClip($clipId)
	{
		$uploads_dir = 'uploads/soundclips';
		//var_dump($_FILES); die;
		if (!$_FILES["fileUpload"]["error"]) {
			$tmp_name = $_FILES["fileUpload"]["tmp_name"];
			$name = $_FILES["fileUpload"]["name"];
			//$id = explode(".",$name);
			$fileUrl = "http://".$_SERVER['HTTP_HOST']."/oztinate/uploads/soundclips/".$name;
			move_uploaded_file($tmp_name, "$uploads_dir/$name");
			$result = mysql_query("select assignedTaskId from soundclip where  clipId='".$clipId."'");
			if(!mysql_num_rows($result))
				return array("status"=>"Error","clipId"=>$clipId,"errorMessage"=>"Invalid clip name. Please check your clip file name");
			
			$asstaskId = mysql_fetch_array($result);
			$asstaskId = $asstaskId["assignedTaskId"];
			
			$query = "update soundclip set clipName='$name', clipUrl='$fileUrl', uploadStatus='Y' where clipId=".$clipId;
			if(!mysql_query($query))
			{
				return array("status"=>"Error","clipId"=>$clipId,"errorMessage"=>"Details update error.Please check file name");
			}
			else{
			
				$result = mysql_query("select assignedTaskId from soundclip where uploadStatus='N' and assignedTaskId=(select assignedTaskId from soundclip where clipId=".$clipId.")"); 
				
				if(!mysql_num_rows($result))
				{
					$row = mysql_fetch_array($result);
					mysql_query("update assignedtask set status=4,updatedId=NOW() where status=3 and Id=".$asstaskId);
				}
				return array("status"=>"Success","clipId"=>$clipId,"errorMessage"=>"");
			}	
		}
		else{
				return array("status"=>"Error","clipId"=>$clipId,"errorMessage"=>"File upload error. please upload again");
			}	
	}
		
	
	function updateAssignedTasks($data)
	{
		$updatedTask = $data["assignedTask"];
		if($data["newTask"]==0)
		{
			$i=0;
			$updatedIds= array();
			
			if($updatedTask["status"]==2) $updatedTask["status"]=3;
				
			$result =mysql_query("update assignedtask set status=".$updatedTask["status"].",updatedId='".$updatedTask["updatedId"]."' where Id=".$updatedTask["assignedTaskId"]);
			if(!$result)
			{
				return array("status"=>"Error","errorMessage"=>"Assigned: ".$updatedTask["assignedTaskId"].". not updated");
			}
			
			//This function will insert check soundclips existing, insert if itsnot and return existing and inserted IDS
			$soundClipDetails = $this->addSoundClips($updatedTask["soundClips"],$updatedTask["assignedTaskId"]);
			
			return array("status"=>"Success","taskStatus"=>array("status"=>"Success","updatedTasks"=>array("oldTaskId"=>"","newTaskId"=>"")),"assignedTaskStatus"=>array("status"=>"Success","updatedAssTask"=>array("oldAssTask"=>"","newAssTaskId"=>"")),"soundClipStatus"=>array("status"=>"Success","updatedSoundClips"=>$soundClipDetails[0],"extingSoundClips"=>$soundClipDetails[1]));
			//return array("status"=>"Success","updatedSoundClips"=>$updatedSoundClipIds);
		}
		else
		{
	
			$task = new Task();
			
			$taskStatus = $task->addTask($updatedTask["task"]);			
			if($taskStatus=="Exist")
				return array("status"=>"Error", "errorMessage"=>"Task already exist please change the task name");
			if($taskStatus=="Error")
				return array("status"=>"Error", "errorMessage"=>"Error on updating taskId: ".$updatedTask["task"]["taskId"]);
			elseif($taskStatus=="Success")
			{
				$row = mysql_fetch_array(mysql_query("select taskId from task order by taskId DESC limit 1"));
				$task = $row["taskId"];	
				$updatedTaskIds = array("status"=>"Success","updatedTasks"=>array("oldTaskId"=>$updatedTask["task"]["taskId"], "newTaskId"=>intval($task)));
				
				$updatedTask["taskId"]= $task;
				
				$assTaskStatus = $this->assignTask($updatedTask,"Y");
				if($assTaskStatus=="Success")
				{
					$assTaskId = mysql_insert_id();
					$updatedAssTaskIds = array("status"=>"Success","updatedAssTask"=>array("oldAssTask"=>$updatedTask["assignedTaskId"],"newAssTaskId"=>$assTaskId));
					
					//This function will insert check soundclips existing, insert if itsnot and return existing and inserted IDS
					$soundClipDetails = $this->addSoundClips($updatedTask["soundClips"],$assTaskId);
					return array("status"=>"Success","taskStatus"=>$updatedTaskIds,"assignedTaskStatus"=>$updatedAssTaskIds,"soundClipStatus"=>array("status"=>"Success","updatedSoundClips"=>$soundClipDetails[0],"extingSoundClips"=>$soundClipDetails[1]));
				}
				else
				{
					$updatedAssTaskIds = array("status"=>"Error on updating assignedTask Id:".$updatedTask["assignedTaskId"]);
				}
						
			}	
			
		}	
	}
	
	function addSoundClips($soundClips,$assTaskId)
	{
		$updatedIds = array();
		$existingClips =array();
		$clipDetails = array();
		//Getting all the soundclips in the assigned task to avoid duplicated soundclips
		

		
		foreach($soundClips as $soundClip){
				
				//echo  "select clipId from soundclip where clipName='".$soundClip["name"]."' and assignedTaskId=".$assTaskId;	
				$result = mysql_query("select clipId from soundclip where clipName='".$soundClip["name"]."' and assignedTaskId=".$assTaskId);
				if(!mysql_num_rows($result))
				{
					$result = mysql_query("insert into soundclip (assignedTaskId,clipName,updatedId,createdDate) values(".$assTaskId.",'".$soundClip["name"]."','".$soundClip["dateCreated"]."','".$soundClip["dateCreated"]."')");
					if($result)
					{
						$id = mysql_insert_id();
						array_push($updatedIds,array("oldClipId"=>$soundClip["clipId"],"newClipId"=>$id));
					}
					else
					{
						return array("status"=>"Error","errorMessage"=>"Error on updating clipId: ".$soundClip["clipId"], "updatedClipIds"=>$updatedIds);
					}
				}
				else{
					
					array_push($existingClips,$soundClip["clipId"]);
				}								
			}
			
			
		array_push($clipDetails,$updatedIds);	
		array_push($clipDetails,$existingClips);
		return $clipDetails;
	}
	
	function getDetails($id)
	{
		$query = "SELECT Id,task.taskName,users.userName,status,assignedDate,completionDate FROM assignedtask as asstask JOIN task ON asstask.taskId=task.taskId LEFT JOIN users ON asstask.userId=users.userId WHERE Id=".$id;
		$result = mysql_query($query);
		if($result)
		{
			return $row=mysql_fetch_array($result);
		}
		else
		 return array("status"=>"Error","errorMessage"=>"Query Error");	
	}
	
	function deleteAssTask($id)
	{
				if(mysql_query("delete from assignedtask where Id=".$id) or die(mysql_error()))
				{
					return "1";
				}
				else
					return "2";
	}
	
	function getAllAsstask(){
		$query = "SELECT Id,task.taskName,users.userName,status,assignedDate,completionDate FROM assignedtask as asstask JOIN task ON asstask.taskId=task.taskId LEFT JOIN users ON asstask.userId=users.userId";
		$result = mysql_query($query);
		if($result)
		{
			//while($row=mysql_fetch_array($result)){continue;}
			return $result;
		}
		else
		 return array("status"=>"Error","errorMessage"=>"Query Error");	
	}
	
	function changeStatus($status,$id)
	{
		$query="update assignedtask set status=".$status.",updatedId=NOW() where Id=".$id;
		if(mysql_query($query))
			return 1;
		else
			return 2;
		
	}
	
	function addComment($data)
	{
		$query="insert into comments (assignedTaskId,commentUser,commentText,createdDate) values(".$data["assTaskId"].",".$data["userId"].",'".$data["comment"]."',NOW())";
		
		if(mysql_query($query)) 
		{
			$id = mysql_insert_id();
			mysql_query("update assignedtask set updatedId=NOW() where Id=".$data["assTaskId"]);
			return json_encode(mysql_fetch_array(mysql_query("select commentText,createddate from comments where commentId=".$id)));
			
			//return "Success";
		}	
		else
			return "Error";
	}
	
	function getComments($taskId)
	{
		$query = "select comments.*, users.userName from comments left join users on comments.commentUser=users.userId where assignedTaskId=".$taskId." order by createdDate DESC";
		$result = mysql_query($query);
		if($result)
		{
			return $result;
		}
		else
		 return array("status"=>"Error","errorMessage"=>"Query Error");	
	}
	
	function getSoundClips($taskId)
	{
		$query = "select * from soundclip where assignedTaskId=".$taskId;
		$result = mysql_query($query);
		if($result)
		{
			return $result;
		}
		else
		 return array("status"=>"Error","errorMessage"=>"Query Error");	
	}
	
}
?>
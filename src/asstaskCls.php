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
		if($newformat<date('Y-m-d'))
			return array("status"=>"Error","message"=>"Error...!!! Invalid Completion date");
			
		$query="INSERT INTO assignedtask (taskId,userId,status,createdUserId,minDuration,practiceDuration,assignedDate,completionDate,isCreatedByUser,updatedId,createdDate) values(".$data["taskId"].",".$data["userId"].",".$data["status"].",".$data["createdUserId"].",".$data["minDuration"].",".$data["practiceDuration"].",'".$data["dateOfAssign"]."','".$newformat."','".$createdByUser."','".$data["updatedId"]."',NOW())";
		//die; 
		
		if(mysql_query($query)) 
		{
			$assTaskId = mysql_insert_id();
			if($createdByUser=='N')
			{
				$pns = new PNS();
				$pns->push(array("type"=>"assign","userId"=>$data["userId"]));
			}
			
			return array("status"=>"Success","assTaskId"=>$assTaskId,"message"=>"Exercise Assigned Successfully..!!!");
		}	
		else
			return array("status"=>"Error","assTaskId"=>$assTaskId,"message"=>"Error...!!! Exercise is not assigned");
		
	}
	
	function updateAssignedTask($data)
	{
		$time = strtotime($data["dateOfCompletion"]);
		$newformat = date('Y-m-d',$time);	
		if($newformat<=date('Y-m-d'))
			return array("status"=>"Error","message"=>"Error...!!! Invalid Completion date");
			
		if(mysql_query("update assignedtask set completionDate='".$newformat."',updatedId=NOW() where Id=".$data["txtAssTaskId"]))
		{
			
			$query = "SELECT users.userId from assignedtask JOIN users ON assignedtask.userId=users.userId WHERE assignedtask.Id=".$data["txtAssTaskId"];

			$result = mysql_query($query);
			if(mysql_num_rows($result)){
				$row=mysql_fetch_array($result);
				//echo $data["userId"];
				$pns = new PNS();
				$pns->push(array("type"=>"update","userId"=>$row["userId"]));	
				//var_dump($response);
			}	
			return array("status"=>"Success","message"=>"Assignment Updated Successfully..!!!");
		}	
		else
			return array("status"=>"Error","message"=>"Error...!!! Assignment cannot update..!!!");
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
				return array("status"=>"Error","clipId"=>$clipId,"message"=>"Invalid clip name. Please check your clip file name");
			
			$asstaskId = mysql_fetch_array($result);
			$asstaskId = $asstaskId["assignedTaskId"];
			
			$query = "update soundclip set clipName='$name', clipUrl='$fileUrl', uploadStatus='Y' where clipId=".$clipId;
			if(!mysql_query($query))
			{
				return array("status"=>"Error","clipId"=>$clipId,"message"=>"Details update error.Please check file name");
			}
			else{
			
				$result = mysql_query("select assignedTaskId from soundclip where uploadStatus='N' and assignedTaskId=(select assignedTaskId from soundclip where clipId=".$clipId.")"); 
				
				if(!mysql_num_rows($result))
				{
					$row = mysql_fetch_array($result);
					mysql_query("update assignedtask set status=4,updatedId=NOW() where status=3 and Id=".$asstaskId);
				}
				return array("status"=>"Success","clipId"=>$clipId,"message"=>"");
			}	
		}
		else{
				return array("status"=>"Error","clipId"=>$clipId,"message"=>"File upload error. please upload again");
			}	
	}
		
	
	function updateAssignedTasks($data)
	{
		
		$updatedTask = $data["assignedTask"];
		if($data["newTask"]==0)
		{
			//get the assigned task status from db to check it is aborted already
			$row=mysql_fetch_array(mysql_query("select status from assignedtask where Id=".$updatedTask["assignedTaskId"]));
			if($row["status"]==6)
				return array("status"=>"Error","message"=>"This Exercise is already aborted by admin. Please sync the app to update the data.");
				
			$i=0;
			$updatedIds= array();
			
			if($updatedTask["status"]==2) $updatedTask["status"]=3;
				
			$result =mysql_query("update assignedtask set status=".$updatedTask["status"].",updatedId='".$updatedTask["updatedId"]."' where Id=".$updatedTask["assignedTaskId"]);
			if(!$result)
			{
				return array("status"=>"Error","message"=>"Assigned: ".$updatedTask["assignedTaskId"].". not updated");
			}
			
			//This function will insert check soundclips existing, insert if itsnot and return existing and inserted IDS
			$soundClipDetails = $this->addSoundClips($updatedTask["soundClips"],$updatedTask["assignedTaskId"]);
			
			return array("status"=>"Success","taskStatus"=>array("status"=>"Success","updatedTasks"=>array("oldTaskId"=>"","newTaskId"=>"")),"assignedTaskStatus"=>array("status"=>"Success","updatedAssTask"=>array("oldAssTask"=>"","newAssTaskId"=>"")),"soundClipStatus"=>array("status"=>"Success","updatedSoundClips"=>$soundClipDetails[0],"extingSoundClips"=>$soundClipDetails[1]));
			//return array("status"=>"Success","updatedSoundClips"=>$updatedSoundClipIds);
		}
		else
		{
	
			$task = new Task();
			
			$time = strtotime($updatedTask["dateOfCompletion"]);
			$newformat = date('Y-m-d',$time);	
			//This prevent user submit task after completion date (Commented as per client request).
			if($newformat<date('Y-m-d'))
				return array("status"=>"Error","message"=>"Completion date is less than current date");
				
			
			if($task->checkTaskExist($updatedTask["task"]["taskName"])=="true")
			{
					return array("status"=>"Error", "message"=>"Task already exist please change the task name");
			}
			
			
			
			//Insert tablatures
			$resultTabs = $this->addTabs($updatedTask["task"]["tabs"]);
			$newTabids = implode(",",$resultTabs["newIds"]);
		
			$updatedTask["task"]["tabIds"] = $newTabids;
			
			$taskStatus = $task->addTask($updatedTask["task"]);			
			
			

			if($taskStatus["status"]=="Error"){
				
				return array("status"=>"Error", "message"=>"Error on updating taskId: ".$updatedTask["task"]["taskId"]);
			}
			elseif($taskStatus["status"]=="Success")
			{
				
				$row = mysql_fetch_array(mysql_query("select taskId from task order by taskId DESC limit 1"));
				$task = $row["taskId"];	
				$updatedTaskIds = array("status"=>"Success","updatedTasks"=>array("oldTaskId"=>$updatedTask["task"]["taskId"], "newTaskId"=>intval($task)));
				
				$updatedTask["taskId"]= $task; 

				$updatedTask["minDuration"]=$updatedTask["task"]["minDuration"];
				$updatedTask["practiceDuration"]=$updatedTask["task"]["practiceDuration"];
				
				$assTaskStatus = $this->assignTask($updatedTask,"Y");
				//var_dump($assTaskStatus); die;
				if($assTaskStatus["status"]=="Success")
				{
					$assTaskId = $assTaskStatus["assTaskId"];

					$updatedAssTaskIds = array("status"=>"Success","updatedAssTask"=>array("oldAssTask"=>$updatedTask["assignedTaskId"],"newAssTaskId"=>$assTaskId));
					
					//This function will insert check soundclips existing, insert if itsnot and return existing and inserted IDS
					$soundClipDetails = $this->addSoundClips($updatedTask["soundClips"],$assTaskId);
					return array("status"=>"Success","taskStatus"=>$updatedTaskIds,"assignedTaskStatus"=>$updatedAssTaskIds,"soundClipStatus"=>array("status"=>"Success","updatedSoundClips"=>$soundClipDetails[0],"extingSoundClips"=>$soundClipDetails[1]),"tabStatus"=>array("status"=>"Success","updatedTabs"=>$resultTabs["insertedTabs"],/*"extingTabs"=>$resultTabs["existingTabs"],*/"failedTabs"=>$resultTabs["failedTabs"]));
				}
				else
				{
					return $updatedAssTaskIds = array("status"=>"Error","message"=> "Error on updating assignedTask Id:".$updatedTask["assignedTaskId"]);
				}
						
			}	
			
		}	
	}
	
/*	function addTabIdsToTask($taskTabs,$newtabs)
	{
		foreach($tasks)
		foreach($tabs as $tab)
		{
			
		}		
	}*/
	function addTabs($tabs)
	{
		$tabclass = new Tab();
		//$result = array();
		$newTabIds = array();
		$insertedTabs = array();
		$failedIds= array();
		$existingTabs =array();
		foreach($tabs as $tab)
		{	
			/*if($tabclass->checkTabExistForTask($tab["name"])=="true")
			{
				array_push($existingTabs,$tab["tabId"]);
				continue;
			}*/
			
			$query = "insert into tablature (name,updatedId,createdDate) values('".$tab["name"]."',NOW(),'".$tab["dateCreated"]."')";
			
			$result = mysql_query($query);
			if($result){
				$newId=mysql_insert_id();
				array_push($insertedTabs,array("oldTabId"=>$tab["tabId"],"newTabId"=>$newId));
				array_push($newTabIds,$newId);
				}else{
				array_push($failedIds,$tab["tabId"]);
			}
		}	
		return array("newIds"=>$newTabIds,"insertedTabs"=>$insertedTabs,"failedTabs"=>$failedIds/*,"existingTabs"=>$existingTabs*/);
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
						return array("status"=>"Error","message"=>"Error on updating clipId: ".$soundClip["clipId"], "updatedClipIds"=>$updatedIds);
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
		$query = "SELECT Id,task.taskId,task.taskName,users.userId,users.userName,status,asstask.minDuration, asstask.practiceDuration, assignedDate,completionDate FROM assignedtask as asstask JOIN task ON asstask.taskId=task.taskId LEFT JOIN users ON asstask.userId=users.userId WHERE Id=".$id;
		$result = mysql_query($query);
		if($result)
		{
			return $row=mysql_fetch_array($result);
		}
		else
		 return array("status"=>"Error","message"=>"Query Error");	
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
	
	function getAllAsstask($limitFrom,$limitTo,$search=null){
		$queryString="";
		$orderString="";
		if(isset($search))
		{	
			$flag=false;
			//$queryString = "where";
			if(isset($search["userName"])&&$search["userName"]!="")
			{
				$queryString="where users.userName LIKE '%".$search["userName"]."%'";
				$flag=true;
			}

			if(isset($search["status"])&&$search["status"]!="-1")
			{
				if($flag)
				{
					$queryString.=" AND status=".$search["status"];
				}else{

					$queryString = "where status=".$search["status"];
				}
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

		//$queryString;	

	 $query = "SELECT Id,task.taskName,users.userName,status,assignedDate,completionDate FROM assignedtask as asstask JOIN task ON asstask.taskId=task.taskId LEFT JOIN users ON asstask.userId=users.userId ".$queryString." ".$orderString." LIMIT ".$limitFrom.",".$limitTo;
		$result = mysql_query($query);
		if($result)
		{
			//while($row=mysql_fetch_array($result)){continue;}
			return $result;
		}
		else
		 return array("status"=>"Error","message"=>"Query Error");	
	}

	function getRecordCount($search=null){

		$queryString="";
		
		if(isset($search))
		{	
			$flag=false;
			//$queryString = "where";
			if(isset($search["userName"])&&$search["userName"]!="")
			{
				$queryString="where users.userName LIKE '%".$search["userName"]."%'";
				$flag=true;
			}

			if(isset($search["status"])&&$search["status"]!="-1")
			{
				if($flag)
				{
					$queryString.=" AND status=".$search["status"];
				}else{

					$queryString = "where status=".$search["status"];
				}
			}

		}

		$query = "SELECT COUNT(*) as total_count FROM assignedtask as asstask JOIN task ON asstask.taskId=task.taskId LEFT JOIN users ON asstask.userId=users.userId ".$queryString;
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
	
	function changeStatus($status,$id)
	{   
		$changeUser="";
		if($status==1){
				$changeUser = " createdUserId=".$_SESSION["userId"].", isCreatedByUser='N',";
			}	
		$query="update assignedtask set status=".$status.",".$changeUser." updatedId=NOW() where Id=".$id;
		if(mysql_query($query))
		{
			$query = "SELECT users.userId,taskName from assignedtask JOIN users ON assignedtask.userId=users.userId JOIN task ON assignedtask.taskId=task.taskId  WHERE assignedtask.Id=".$id;
			$result = mysql_query($query);
			if(mysql_num_rows($result)){
				$row=mysql_fetch_array($result);

				$pns = new PNS();
				$pns->push(array("type"=>"status","userId"=>$row["userId"],"exercise"=>$row["taskName"],"newStatus"=> $this->getTaskStatus($status)));
				//var_dump($response);
			}	

			return 1;
		}
		else
			return 2;
		
	}

	function getTaskStatus($status)
	{
		switch($status){
		case 0:
				return "Open";
		case 1:
				return "Reopen";
		case 3:
				return "ReadyForReviewButUploadPending";
		case 4:
				return "ReadyForReview";
		case 5:
				return "Completed";
		case 6:
				return "Aborted";		
		default: 
			return "Unknown Status";
		}	
	}
	
	function addComment($data)
	{
		$query="insert into comments (assignedTaskId,commentUser,commentText,createdDate) values(".$data["assTaskId"].",".$data["userId"].",'".$data["comment"]."',NOW())";
		
		if(mysql_query($query)) 
		{
			$id = mysql_insert_id();
			mysql_query("update assignedtask set updatedId=NOW() where Id=".$data["assTaskId"]);

			$query = "SELECT taskName,users.userId from assignedtask JOIN task ON assignedtask.taskId=task.taskId JOIN users ON assignedtask.userId=users.userId WHERE assignedtask.Id=".$data["assTaskId"];

			$result = mysql_query($query);
			if(mysql_num_rows($result)){
				$row=mysql_fetch_array($result);
				//echo $data["userId"];
				$pns = new PNS();
				$pns->push(array("type"=>"comment","userId"=>$row["userId"],"exercise"=> $row["taskName"]));
				//var_dump($response);
			}	

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
		 return array("status"=>"Error","message"=>"Query Error");	
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
		 return array("status"=>"Error","message"=>"Query Error");	
	}
	
}
?>
<?php
class Task{

function sync($data){
	//echo "SELECT Id FROM assignedtask WHERE updatedId>".$data["latestAssignedTaskUpdatedId"];
	/*$result = mysql_query("SELECT Id FROM assignedtask WHERE updatedId>'".$data["latestAssignedTaskUpdatedId"]."'");
	if(!$result)
		return "{'status':'Success','Message':'No update found'}";
		
	/*if(!mysql_num_rows($result))
	{
		return "{'status':'Success','Message':'No update found'}";
	}*/
	
	$taskList = array();
	$taskList["status"]="Success";
	$taskList["errorMessage"]="Nil";
	$taskList["updatedAssignedTasks"]= array();
	$i=0;
	
		 $query = "SELECT Id AS assTaskId,userId,assignedtask.updatedId,status,createdUserId,assignedDate AS dateOfAssign,completionDate AS dateOfCompletion,assignedtask.createdDate AS dateOfCreation,task.taskId,taskName,details,instruction,minDuration,practiceDuration,task.createdDate FROM assignedtask JOIN task ON assignedtask.taskId=task.taskId WHERE assignedtask.userId=".$data["sessionToken"]." AND assignedtask.updatedId>'".$data["latestAssignedTaskUpdatedId"]."'";
		//die;
		$result = mysql_query($query);
		if($result)
		{
			while($row=mysql_fetch_array($result)){
			array_push($taskList["updatedAssignedTasks"],$this->getAssignTaskData($row));
			}
		}

	return 	$taskList;
}

function addTask($data)
{
	
	
	
	//var_dump($data);
	
	if(!isset($data["createdUserId"]))
		$data["createdUserId"]  = $_SESSION["userId"];
		
	if(!isset($data["updatedId"]))
		$data["updatedId"] = date('Y-m-d H:i:s');

	if(!isset($data["dateOfCreation"]))
		$data["dateOfCreation"] = date('Y-m-d H:i:s');	
	
	if(!isset($data["details"]))
		$data["details"]="";
			
	$query = "INSERT INTO task (taskName,instruction,minDuration,practiceDuration,details,createdDate,createdUser,updatedId) values('".mysql_real_escape_string($data["taskName"])."','".mysql_real_escape_string($data["instruction"])."',".$data["minDuration"].",".$data["practiceDuration"].",'".mysql_real_escape_string($data["details"])."','".$data["dateOfCreation"]."',".$data["createdUserId"].",'".$data["updatedId"]."')";
	// die;
	$result = mysql_query($query);
	$id = mysql_insert_id();
	if($result)
	{
		if(isset($data["tabIds"]))
		{
			$tabs = explode(",",$data["tabIds"]);
			if($tabs[0]=="")
				unset($tabs[0]);
				
			foreach($tabs as $tab)
			{
				//echo  "INSERT INTO tasktablatures (taskId,tablatureId) values(".$id.",".$tab.")";
				
				mysql_query("INSERT INTO tasktablatures (taskId,tablatureId) values(".$id.",".$tab.")");
				
			} 
		}		 
		return "Success";
	}	
	else
		return "Error";
}

function deleteTask($id)
{
		$result=mysql_fetch_array(mysql_query("select count(*) as count from assignedtask where status<5 AND taskId=".$id));
		if(!$result["count"])
		{	
				if(mysql_query("delete from task where taskId=".$id) or die(mysql_error()))
				{
					return "1";
				}
				else
					return "2";
		}
		else
			return "3";
			
}

function checkTaskExist($taskName)
	{
		$result=mysql_fetch_array(mysql_query("select count(*) as count from task where taskName='".$taskName."'"));
		if($result["count"])
		{	
			return "true";
		}
		else{
			return "false";
		}
		
	}

	function getTaskNames()
	{
		$query="SELECT taskId,taskName FROM task WHERE enabled=1";
		$result = mysql_query($query);
		if($result)
		{
			//while($row=mysql_fetch_array($result)){continue;}
			return $result;
		}
		else
		 return array("status"=>"Error","message"=>"Query Error");	
	}

function getAllTasks()
{
	$query ="SELECT taskId,taskName,minDuration,practiceDuration,details,createdDate FROM task WHERE enabled=1 ORDER BY createdDate DESC";
	$result = mysql_query($query);
	if($result)
	{
		//while($row=mysql_fetch_array($result)){continue;}
		return $result;
	}
	else
	 return array("status"=>"Error","message"=>"Query Error");	
}

function getAssignTaskData($row)
{ 
	$assTask= array();
	
	$assTask["taskId"]=$row["assTaskId"];
	$assTask["updatedId"]=$row["updatedId"];
	$assTask["status"]=$row["status"];
	$assTask["createdUserId"]=$row["createdUserId"];
	$assTask["dateOfAssign"]=$row["dateOfAssign"];
	$assTask["dateOfCompletion"]=$row["dateOfCompletion"];
	$assTask["dateOfCreation"]=$row["dateOfCreation"];
	$assTask["task"]=array();
	$assTask["task"]["taskId"]=$row["taskId"];
	$assTask["task"]["name"]=$row["taskName"];
	$assTask["task"]["details"]=$row["details"];
	$assTask["task"]["instruction"]=$row["instruction"];
	$assTask["task"]["practiceDuration"]=$row["practiceDuration"];
	$assTask["task"]["minDuration"]=$row["minDuration"];	
	$assTask["task"]["dateOfCreation"]=$row["createdDate"];	
	$assTask["task"]["tabs"]= array();
	
	$query = "SELECT tabId,name,tabUrl,taskId FROM tablature JOIN tasktablatures ON tablature.tabId=tasktablatures.tablatureId WHERE taskId=".$row["taskId"];
	$result = mysql_query($query);
	$i=0;
	if($result)
	{
		while($row=mysql_fetch_array($result))
		{
			$assTask["task"]["tabs"][$i]=array();
			$assTask["task"]["tabs"][$i]["tabId"]=  $row["tabId"];
			$assTask["task"]["tabs"][$i]["name"]=	$row["name"];
			//$assTask["task"]["tabs"][$i]["tabUrl"]=$row["tabUrl"];
			$assTask["task"]["tabs"][$i]["tabUrl"]=($row["tabUrl"])?$row["tabUrl"]:"";
			$i++;
		}
	}	
	
	$query = "SELECT commentId,commentText,createdDate FROM comments WHERE assignedTaskId=".$assTask["taskId"];
	$result = mysql_query($query);
	$i=0;
	if($result)
	{
		while($row=mysql_fetch_array($result))
		{
			$assTask["comments"][$i]=array();
			$assTask["comments"][$i]["commentId"]=  $row["commentId"];
			$assTask["comments"][$i]["comment"]=	$row["commentText"];
			$assTask["comments"][$i]["dateModified"]= $row["createdDate"];
			$i++;
		}
	}	
	return $assTask;
}
}

?>
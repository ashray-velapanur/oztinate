<?php
class PNS{

	function registerDevice($data){
		
		if($data["deviceType"]!="IOS" && $data["deviceType"]!="Android"){
			return array("status"=>"Error","errorMessage"=>"Invalid Device Type");
		}

		$result = mysql_query("SELECT id FROM mobilepns WHERE userId=".$data["userId"]);

		if(mysql_num_rows($result)){

			$row=mysql_fetch_array($result);

			$result = mysql_query("UPDATE mobilepns SET userId=".$data["userId"].", deviceToken='".$data["deviceToken"]."', channelId='".$data["channelId"]."', updatedDate=NOW() WHERE id=".$row['id']);

			
			if($result){
				//$deviceId = mysql_insert_id();
				return array("status"=>"Success","deviceId"=>$row["id"],"message"=>"Device Registered Successfully");
			}
			else
				return array("status"=>"Error","errorMessage"=>"Device is not registered please try again later");
		}
		else{	
	
			$result = mysql_query("INSERT INTO mobilepns (userId,deviceToken,deviceType,createdDate) VALUES(".$data["userId"].",'".$data["deviceToken"]."','".$data["deviceType"]."',NOW())");
			
			if($result){
				$deviceId = mysql_insert_id();
				return array("status"=>"Success","deviceId"=>$deviceId,"message"=>"Device Registered Successfully");
			}
			else
				return array("status"=>"Error","errorMessage"=>"Device is not registered please try again later");
		}	
	}


	
	
}
?>
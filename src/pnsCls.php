<?php
//include_once('pns/pusher.php');

require_once 'pns/vendor/autoload.php';
use UrbanAirship\Airship;
use UrbanAirship\UALog;
use UrbanAirship\Push as P;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class PNS{

	function registerDevice($data){
		
		if($data["deviceType"]!="IOS" && $data["deviceType"]!="Android"){
			return array("status"=>"Error","message"=>"Invalid Device Type");
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
				return array("status"=>"Error","message"=>"Device is not registered please try again later");
		}
		else{	
	
			$result = mysql_query("INSERT INTO mobilepns (userId,deviceToken,deviceType,createdDate) VALUES(".$data["userId"].",'".$data["deviceToken"]."','".$data["deviceType"]."',NOW())");
			
			if($result){
				$deviceId = mysql_insert_id();
				return array("status"=>"Success","deviceId"=>$deviceId,"message"=>"Device Registered Successfully");
			}
			else
				return array("status"=>"Error","message"=>"Device is not registered please try again later");
		}	
	}
	function getDeviceToken($userId)
	{
		//echo "SELECT deviceToken,deviceType,userName FROM users JOIN mobilepns ON users.userId=mobilepns.userId WHERE users.userId=".$userId;
		$result = mysql_query("SELECT deviceToken,deviceType,userName FROM users JOIN mobilepns ON users.userId=mobilepns.userId WHERE users.userId=".$userId);
		if(mysql_num_rows($result)){
			return mysql_fetch_array($result);
			
		}else return null;
	}
	
	function getMessage($userName, $messageData)
	{
		switch($messageData["type"])
		{
			case "assign":
							return "Hi ".$userName.", new exercise assigned...";							
			case "status":
							if($messageData["newStatus"]=="Aborted")
								return "Hi ".$userName.", ".$messageData["exercise"]." aborted by teacher";
							if($messageData["newStatus"]=="Reopen")
								return "Hi ".$userName.", ".$messageData["exercise"]." reopened by teacher";
							if($messageData["newStatus"]=="Completed")	
								return "Hi ".$userName.", ".$messageData["exercise"]." marked completed by teacher";

							return "Hi ".$userName.", teacher changed ".$messageData["exercise"]." to ".$messageData["newStatus"];	
			case "comment":
							return "Hi ".$userName.", teacher has commented on ".$messageData["exercise"];
			case "update":	
							return "Hi ".$userName.", some tasks has been updated. Please refresh your app";

			default:	return null;			
		}		
		
	}
	
	function push($messageData)
	{
		$airship = new Airship("p4hzFE_yTCSAKHcsH7NP9Q", "CfLjQaQgQveKv1Vrb23fPw");
		$deviceDetails = $this->getDeviceToken($messageData["userId"]);
		if(!$deviceDetails) return "Not set Push notifications"; 
		
		$message = $this->getMessage($deviceDetails["userName"],$messageData);
		if($deviceDetails["deviceType"]=="IOS"){	
			return $response = $airship->push()
			->setAudience(P\deviceToken($deviceDetails["deviceToken"]))
			->setNotification(P\notification(null,array("ios"=>P\ios($message, "+1"))))
			->setDeviceTypes(P\deviceTypes('ios'))
			->send();
		}else if($deviceDetails["deviceType"]=="Android"){

			return $response = $this->airship->push()
			->setAudience(P\deviceToken($deviceDetails["deviceToken"]))
			->setNotification(P\notification($message))
			->setDeviceTypes(P\deviceTypes('android'))
			->send();
		}	
		
	}


	
	
}
?>
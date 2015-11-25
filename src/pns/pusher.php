<?php

require_once 'vendor/autoload.php';

use UrbanAirship\Airship;
use UrbanAirship\UALog;
use UrbanAirship\Push as P;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class UrbanPns
{
	public $airship;
//UALog::setLogHandlers(array(new StreamHandler("php://stdout", Logger::INFO)));
//$airship = new Airship("key", "secret");
	/*public function __construct()
    {
        //$this->key = "WgrIyb-5R6iUAE6a6lukfQ";
        //$this->secret = "k9BvvS_nSnO-kFwdi1t16w";
		
    }*/
	
	function push($data)
	{
		$this->airship = new Airship("WgrIyb-5R6iUAE6a6lukfQ", "Amf6Z0aMS2O3Miiff9NXtQ");
		return $response = $this->airship->push()
		->setAudience(P\deviceToken("b3ed5bdde70dc79c451eb947399a225f6be26d381043d3ee8ab2b1c4374fe5ea"))
		->setNotification(P\notification("Hello from PHP"))
		->setDeviceTypes(P\deviceTypes('ios'))
		->send();
		
	}	
}

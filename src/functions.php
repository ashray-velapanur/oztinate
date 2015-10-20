<?php

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

function getStausId($status)
{
	switch($status){
	case "Open":
			return 0;
	case "Reopen":
			return 1;
	case "ReadyForReviewButUploadPending":
			return 3;
	case "ReadyForReview":
			return 4;
	case "Completed":
			return 5;
	case "Abort":
			return 6;		
	default: 
		return -1;
	}
}

function getNextStatus($status)
{
	switch($status){
	case 0:
			return array("Abort");
	case 1:
			return array("Abort");
	case 3:
			return array("Abort");
	case 4:
			return array("Reopen","Completed","Abort");	
	case 6:
			return array("Reopen");
	default: 
		return array();
	}
}

/*function getMinDuration($duration)
{
	switch($status){
	case 0:
			return "Assigned";
	case 1:
			return "Submitted";
	case 3:
			return "Reviewed";
	case 4:
			return "Resubmitted";
	case 5:
			return "Completed";
	default: 
		return "Unknown Status";
	}
}*/

?>
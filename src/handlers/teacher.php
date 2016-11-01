<?php

$app->get('/teacher/create_exercise', function()use($app){
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$task=new Task();
		$response = $task->addTask($_POST);

		$tagNames = explode(",",$_POST["tags"]);
		foreach ($tagNames as $tagName) {
			$tagId = Tag::getOrCreateTag($tagName);
			Tag::assignTag($tagId, $response["taskId"]);
		}
	}
	$app->render("teacher/exercise/create.php");
})->via('GET', 'POST');

$app->get('/teacher/students', function()use($app){
	isTeacherLoggedin($app);
	$teacherid = $_SESSION["userId"];
	$teacher = new Teacher();
	$students = $teacher->getStudents($teacherid);
	$params = array("username"=>$_SESSION['userName'], "students"=>$students);
	$app->render("teacher/student/manage.php", $params);
})->via('GET', 'POST');

$app->get('/teacher/students/:id/delete', function($id)use($app){
	isTeacherLoggedin($app);
	$teacher = new Teacher();
	$students = $teacher->deleteTeacher($id);
})->via('POST');

$app->get('/teacher/update_exercise', function()use($app){
 if($_SERVER['REQUEST_METHOD']=="POST")
 {
	$task = new Task();
	$templateDetails = $task->updateTask($_POST);

 }	
	$id = $_GET["id"];
	$task = new Task();
	$templateDetails = $task->getDetails($id);
	$app->render("teacher/exercise/update.php", $templateDetails);
})->via('GET', 'POST');

$app->get('/teacher/exercises', function()use($app){
	$task = new Task();
	$userId = $_SESSION["userId"];
	$taskNames = $task->getTaskNames($userId);

	$response = array();
	$response["tasks"] = array();

	while($row=mysql_fetch_assoc($taskNames)) {
		array_push($response["tasks"], array("name"=>$row["taskName"], "id"=>$row["taskId"]));
	}

	$app->render("teacher/exercise/list.php", $response);
})->via('GET', 'POST');

$app->get('/teacher/get_exercise', function()use($app){
	$id = $_GET["id"];
	$task=new Task();
	$templateDetails = $task->getDetails($id);
	response($templateDetails);
 })->via('GET');

$app->get('/teacher/review_exercise', function()use($app){
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$rating = new Rating();
		$rating->rate($_POST["assTaskId"], $_POST["rating"]);
	}
	
	$taskId = $_GET["taskId"];
	$assignedTask = new AssignedTask();
	
	$task = $assignedTask->getDetails($taskId);
	$clips = $assignedTask->getSoundClips($taskId);
	$comments = $assignedTask->getComments($taskId);

	$response = array();
	$response["task"] = $task;
	$response["comments"] = array();
	while($row=mysql_fetch_assoc($comments)) {
		array_push($response["comments"], $row["commentText"]);
	}

	$response["clips"] = array();

	while($row=mysql_fetch_assoc($clips)) {
		array_push($response["clips"], $row["clipUrl"]);
	}

	//$params = array("task"=>$task, "clipUrls"=>$clipUrls, "comments"=>$comments);
	$app->render("teacher/exercise/review.php", $response);
 })->via('GET', 'POST');

$app->get('/teacher/student_details', function()use($app){
	$assTasks = new AssignedTask();
	$assignedTasks = $assTasks->getAssTaskNames(null, $_GET["userId"]);
	$params = array("userId"=>$_GET["userId"], "assignedTasks"=>$assignedTasks);
	$app->render("teacher/student/details.php", $params);
 })->via('GET');

$app->get('/teacher/assign_exercise', function()use($app){
 if($_SERVER['REQUEST_METHOD']=="POST")
 {
 	//$data["taskId"].",".$data["userId"].",".$data["status"].",".$data["createdUserId"].",".$data["minDuration"].",".$data["practiceDuration"].",".$data["dateOfAssign"].",'".$newformat."','".$createdByUser."',".$data["updatedId"]
	$assTasks=new AssignedTask();
	$data = $_POST;
	$status = $assTasks->assignTask($data,'N');
 }
	$task = new Task();
	$userId = $_SESSION["userId"];
	$taskNames = $task->getTaskNames($userId);

	$tasks = array();
	while($row=mysql_fetch_assoc($taskNames)) {
		array_push($tasks, array("name"=>$row["taskName"], "id"=>$row["taskId"]));
	}

	$params = array("tasks"=>$tasks, "userId"=>$_GET["userId"]);
	$app->render("teacher/exercise/assign.php", $params);
})->via('GET', 'POST');

$app->get('/teacher/signup', function()use($app){
 if($_SERVER['REQUEST_METHOD']=="POST")
 {
 	$teacher = new Teacher();
	$status = $teacher->addTeacher($_POST);
 }
	$app->render("teacher/signup.php");
})->via('GET', 'POST');

$app->get('/teacher/invite', function()use($app){
 if($_SERVER['REQUEST_METHOD']=="POST")
 {
 	$user = new User();
 	$data["password"] = "pass";
 	$data["userType"] = 2;
 	$data["userName"] = $_POST["email"];
 	$studentid = $user->addUser($data);

 	$teacher = new Teacher();
 	$teacherid = $_SESSION["userId"];
 	$teacher->assignTeacher($teacherid, $studentid);
 }
 	$app->render("teacher/invite.php");
})->via('GET', 'POST');


$app->get('/teacher/login', function()use($app){
 if($_SERVER['REQUEST_METHOD']=="POST")
 {
 	$user = new User();
 	$userdata=$user->teacherLogin($_POST);
 	if($userdata) {
		$_SESSION["userName"] = $_POST["userName"];
		$_SESSION["userId"] = $userdata["userId"];
 		$app->redirect("/oztinate_dev/teacher/home"); 		
 	} else {
 		error_log("not allowed");
 	}
 }
	$app->render("teacher/login.php");
})->via('GET', 'POST');

$app->get('/teacher/home', function()use($app){
	isTeacherLoggedin($app);
	$teacherid = $_SESSION["userId"];
	error_log($_SESSION["userId"]);
	$teacher = new Teacher();
	$students = $teacher->getStudents($teacherid);

	$assTasks = new AssignedTask();
	$assignedTasks = $assTasks->getAssTaskNames(3, null);

	$params = array("username"=>$_SESSION['userName'], "students"=>$students, "tasks"=>$assignedTasks);
	$app->render("teacher/home.php", $params);
})->via('GET', 'POST');

$app->get('/teacher/logout', function()use($app){
   if(isset($_SESSION["userId"]))
   {
	 session_unset();
	 $app->redirect("/oztinate_dev/teacher/login");
   }
  
});

function isTeacherLoggedin($app) {
	# check if user is in db and is a teacher
	if (isset($_SESSION["userId"])) {
		return true;
	} else {
		error_log('not logged in');
		$app->redirect("/teacher/login");
	}
}

?>
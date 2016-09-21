<?php

$app->get('/teacher/create_exercise', function()use($app){
 if($_SERVER['REQUEST_METHOD']=="POST")
 {
	$task=new Task();
	$status = $task->addTask($_POST);	
 }
	$app->render("createexercise.php");
})->via('GET', 'POST');


$app->get('/teacher/signup', function()use($app){
 if($_SERVER['REQUEST_METHOD']=="POST")
 {
 	$teacher = new Teacher();
	$status = $teacher->addTeacher($_POST);
 }
	$app->render("teachersignup.php");
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
 	$app->render("teacherinvite.php");
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
	$app->render("teacherlogin.php");
})->via('GET', 'POST');

$app->get('/teacher/home', function()use($app){
	isTeacherLoggedin($app);
	$teacherid = $_SESSION["userId"];
	error_log($_SESSION["userId"]);
	$teacher = new Teacher();
	$students = $teacher->getStudents($teacherid);
	$params = array("username"=>$_SESSION['userName'], "students"=>$students);
	$app->render("teacherhome.php", $params);
})->via('GET', 'POST');

$app->get('/teacher/logout', function()use($app){
   if(isset($_SESSION["userid"]))
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
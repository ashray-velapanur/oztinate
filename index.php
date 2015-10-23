<?php
include("src/includes.php");
require 'Slim/Slim.php';
 \Slim\Slim::registerAutoloader();
//echo $approot = dirname(__FILE__); die;
$app = new \Slim\Slim();

function response($data)
{	//var_dump($data); die;
	$data = json_encode($data);
	//echo  $data; die;
	header('Content-Type: application/json;charset=UTF-8');
	echo $data;
	exit;
}

$app->post('/login', function (){
   $user = new User();
   $data=file_get_contents('php://input');
   response($user->login($data));
 
});

$app->post('/changePassword', function(){
	$user = new User();
	$data=file_get_contents('php://input');
	$data = json_decode($data, true);
	$userId=checkLoginStatus($data["sessionToken"]);
	$data["userId"] = $userId;
	response($user->changePassword($data));
});

$app->post('/update', function(){
	$data = file_get_contents('php://input');
	$data = json_decode($data, true);
	//var_dump($data); die;
	$userId=checkLoginStatus($data["sessionToken"]);
	
	$assTasks = new AssignedTask();
	response($assTasks->updateAssignedTasks($data));
	
});

$app->post('/sync', function(){
	
	$data = file_get_contents('php://input');
	$data = json_decode($data, true);
	//var_dump($data);
	$userId=checkLoginStatus($data["sessionToken"]);
	
	$data["sessionToken"]=$userId;
		$task = new Task();
		$taskList = $task->sync($data);
	//	header('Content-Type: application/json;charset=UTF-8');
		response($taskList);
	

});

$app->post('/uploadSoundsClip', function(){
	
	$userId=checkLoginStatus($_SERVER["HTTP_SESSIONTOKEN"]);
	
	$assTasks = new AssignedTask();
		response($assTasks->uploadSoundClip($_SERVER["HTTP_CLIPID"]));
	
	
	
});


$app->get('/:admin', function()use($app){
	if(isset($_SESSION["userId"]))
		$app->redirect($GLOBALS['basepath_admin'].'asstasks');
	else
		$app->redirect($app->urlFor('admin_login'));	
})->name('admin')->conditions((array("admin"=>("/*|admin/|admin"))));


$app->map('/admin/login', function ()use($app){
 if($_SERVER['REQUEST_METHOD']=="POST")
 {
   $user = new User();
   $_POST['data']['type']="admin";
   $userdata=$user->adminLogin($_POST);
  // var_dump($userdata); die;
   if($userdata)
   {
		$_SESSION["userId"]=$userdata["userId"];
		$_SESSION["username"] = $_POST["username"];
		$app->redirect($GLOBALS['basepath_admin'].'asstasks');
   }
   else
   { 
		 $app->render("../pages/login.php", array('status','Error','Message','Invalid Credentials..!!!'));
   }
 }
 else
	$app->render("../pages/login.php");
	
})->via('GET', 'POST')->name('admin_login');

$app->map('/admin/home', function ()use($app){
	isAdminLoggedin($app);
	$app->render("../pages/index.php");
})->via('GET', 'POST')->name('admin_home');

$app->map('/:tasks', function ($id)use($app){
	isAdminLoggedin($app);
	$task = new Task();
	$tasks=$task->getAllTasks();
	$id = explode('/',$id);
	$id = end($id);
	$app->render("../pages/tasks.php", array("tasks"=>$tasks,"status"=>$id));
})->via('GET', 'POST')->name('tasks')->conditions((array("tasks"=>("admin/tasks/.*|admin/tasks"))));

$app->get('/admin/deletetask/:id', function($id) use($app){
	isAdminLoggedin($app);
	$task = new Task();
	$result = $task->deleteTask($id);
	$app->redirect("../../admin/tasks/".$result);
});


$app->map('/admin/addtask', function ()use($app){
	isAdminLoggedin($app);
	$status="";
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$task=new Task();
		$status = $task->addTask($_POST);	
	}
	$tab=new Tab();
	$tabs = $tab->getAllTabs();	
	$app->render("../pages/addtask.php",array("status"=>$status,"tabs"=>$tabs));
	
})->via('GET', 'POST')->name('addtask');

$app->post('/admin/checkTaskExist', function() use($app){
	isAdminLoggedin($app);
	$task = new Task();
	echo $task->checkTaskExist($_POST["taskName"]);
});


$app->get('/:users', function($id) use($app){
	isAdminLoggedin($app);
	$users = new User();
	$users=$users->getAllUsers();
	$id = explode('/',$id);
	$id = end($id);
	$app->render("../pages/users.php", array("users"=>$users,"status"=>$id));
})->via('GET', 'POST', 'DELETE')->name('users')->conditions((array("users"=>("admin/users/.*|admin/users"))));

$app->get('/admin/deleteuser/:id', function($id) use($app){
	isAdminLoggedin($app);
	$users = new User();
	$result = $users->deleteUser($id);
	$app->redirect("../../admin/users/".$result);
});

$app->map('/admin/adduser', function ()use($app){
	isAdminLoggedin($app);
	$status="";
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$user=new User();
		$status = $user->addUser($_POST);	
	}
	$app->render("../pages/adduser.php",array("status"=>$status));
})->via('GET', 'POST')->name('adduser');

$app->map('/:asstasks', function ($id)use($app){
	isAdminLoggedin($app);
	$assTasks = new AssignedTask();
	$assTasks=$assTasks->getAllAsstask();
	$id = explode('/',$id);
	$id = end($id);
	$app->render("../pages/asstasks.php", array("assTasks"=>$assTasks,"status"=>$id));
})->via('GET', 'POST')->name('assTasks')->conditions((array("asstasks"=>("admin/asstasks/.*|admin/asstasks"))));

$app->get('/admin/deleteasstask/:id', function($id) use($app){
	isAdminLoggedin($app);
	$assTasks = new AssignedTask();
	$result = $assTasks->deleteAssTask($id);
	$app->redirect("../../admin/asstasks/".$result);
});

$app->map('/admin/addasstask', function ()use($app){
	isAdminLoggedin($app);
	$status="";
	$users = array();
	$tasks = array();
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$assTasks=new AssignedTask();
		$status = $assTasks->assignTask($_POST,'N');	
	}
	$user = new User();
	$task = new Task(); 
	$users=$user->getUserNames();
	$tasks=$task->getTaskNames();
	$app->render("../pages/addasstask.php",array("status"=>$status,"users"=>$users,"tasks"=>$tasks));
})->via('GET', 'POST')->name('addasstask');

$app->map('/admin/viewasstask/:id', function($id)use($app){
	isAdminLoggedin($app);
	$assTasks = new AssignedTask();
	$statusChange=0;
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$status = getStausId($_POST["statusTxt"]);
		$statusChange = $assTasks->changeStatus($status,$id);
	}
	
	$assTask = $assTasks->getDetails($id);
	$comments = $assTasks->getComments($id);
	$soundClips = $assTasks->getSoundClips($id);
	$app->render("../pages/viewasstask.php",array("taskData"=>$assTask,"comments"=>$comments,"soundClips"=>$soundClips,"statusChange"=>$statusChange));
})->via('GET', 'POST')->name('viewasstask');

$app->post('/admin/addComment', function(){
	$assTasks = new AssignedTask();
	echo $assTask = $assTasks->addComment($_POST);
});

$app->map('/:tabs', function ($id)use($app){
	isAdminLoggedin($app);
	$tabs = new Tab();
	$tabList=$tabs->getAllTabs();
	$id = explode('/',$id);
	$id = end($id);
	$app->render("../pages/tablature.php", array("tabs"=>$tabList,"status"=>$id));
	
})->via('GET', 'POST')->name('tabs')->conditions((array("tabs"=>("admin/tabs/.*|admin/tabs"))));

$app->map('/admin/addtab', function ()use($app){
	isAdminLoggedin($app);
	$status="";
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$tab=new Tab();
		$status = $tab->addTab($_POST,$_FILES);	
	}
	$app->render("../pages/addtab.php",array("status"=>$status));
})->via('GET', 'POST')->name('addtab');

$app->get('/admin/deletetab/:id', function($id) use($app){
	isAdminLoggedin($app);
	$tab=new Tab();
	$result = $tab->deleteTab($id);
	$app->redirect("../../admin/tabs/".$result);
});

$app->post('/admin/checkTabExist', function() use($app){
	$tab=new Tab();
	echo $tab->checkTabExist($_POST["tabName"]);
});

$app->get('/admin/logout', function()use($app){
   if(isset($_SESSION["userId"]))
   {
	 session_unset();
	 $app->redirect($app->urlFor('admin_login'));
   }
  
});

function isAdminLoggedin($app)
{
	if(isset($_SESSION["userId"]))
		return true;
	else
		$app->redirect($app->urlFor('admin_login'));
}

function checkLoginStatus($token)
{
	$user= new User();
	$userId = $user->checkLoginStatus($token);
	
	if($userId)
		return $userId;
	else
		response(array("{'status':'Error','ErrorMessage':'Session not valid... Please login'}"));
}

$app->run();
?>
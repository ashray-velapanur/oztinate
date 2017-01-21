<?php

$app->get('/exercises/create', function()use($app){
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $task=new Task();
        if ($_POST['template'] == "newExercise") {
            $response = $task->addTask($_POST); 
        } else {
            $response = $task->updateTask($_POST);
        }
    }

    $task = new Task();
    $userId = $_SESSION["userId"];
    $taskNames = $task->getTaskNames($userId);

    $response = array();
    $response["tasks"] = array();

    while($row=mysql_fetch_assoc($taskNames)) {
        array_push($response["tasks"], array("name"=>$row["taskName"], "id"=>$row["taskId"]));
    }

    $app->render("teacher/exercise/create.php", $response);
})->via('GET', 'POST');

$app->get('/students', function()use($app){
    isTeacherLoggedin($app);
    $teacherid = $_SESSION["userId"];
    $teacher = new Teacher();
    $students = $teacher->getStudents($teacherid);
    $params = array("username"=>$_SESSION['userName'], "students"=>$students);
    $app->render("teacher/student/manage.php", $params);
})->via('GET', 'POST')->name('students');

$app->get('/teacher/students/:id/delete', function($id)use($app){
    isTeacherLoggedin($app);
    $teacher = new Teacher();
    $students = $teacher->deleteTeacher($id);
})->via('POST');

$app->get('/students/:id/goals', function($id)use($app){
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        Goal::createGoal($_POST["tagId"], $_POST["duration"], $_POST["rating"], $_POST["userId"]);
    }   
    $tags = Tag::getTags();
    $params = array("tags"=>$tags, "userId"=>$id);
    $app->render("teacher/goal/create.php", $params);
})->via('GET', 'POST');

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

$app->get('/teacher/list_exercises', function()use($app){
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

$app->get('/exercises/:id/review', function($id)use($app){
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $rating = new Rating();
        $rating->rate($_POST["assTaskId"], $_POST["rating"]);
    }
    
    $assignedTask = new AssignedTask();
    
    $task = $assignedTask->getDetails($id);
    $clips = $assignedTask->getSoundClips($id);
    $comments = $assignedTask->getComments($id);

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

$app->get('/students/:id/details', function($id)use($app){
    $assTasks = new AssignedTask();
    $assignedTasks = $assTasks->getAssTaskNames(null, $id);
    $goals = Goal::getProgress($id);
    $user = new User();
    $name = $user->getNameById($id);
    $params = array("name"=>$name, "userId"=>$id, "assignedTasks"=>$assignedTasks, "goals"=>$goals);
    $app->render("teacher/student/details.php", $params);
 })->via('GET');

$app->get('/students/:id/exercises', function($id)use($app){
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

    $params = array("tasks"=>$tasks, "userId"=>$id);
    $app->render("teacher/exercise/assign.php", $params);
})->via('GET', 'POST');

$app->get('/signup', function()use($app){
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $teacher = new Teacher();
        $status = $teacher->addTeacher($_POST);
        $app->redirect($app->urlFor('login'));
    }
    $app->render("teacher/signup.php");
})->via('GET', 'POST');

$app->get('/invite', function()use($app){
 if($_SERVER['REQUEST_METHOD']=="POST")
 {
    $user = new User();
    $data["password"] = "pass";
    $data["userType"] = 2;
    $data["userName"] = $_POST["email"];
    $data["name"] = $_POST["name"];

    $studentid = $user->addUser($data);

    $teacher = new Teacher();
    $teacherid = $_SESSION["userId"];
    $teacher->assignTeacher($teacherid, $studentid);
 }
    $app->render("teacher/student/invite.php");
})->via('GET', 'POST');


$app->get('/login', function()use($app){
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $user = new User();
        $userdata=$user->teacherLogin($_POST);
        if($userdata) {
            $_SESSION["userName"] = $_POST["userName"];
            $_SESSION["userId"] = $userdata["userId"];
            $app->redirect($app->urlFor('home'));
        }
    }
    $app->render("teacher/login.php");
})->via('GET', 'POST')->name('login');

$app->get('/home', function()use($app){
    isTeacherLoggedin($app);
    $teacherid = $_SESSION["userId"];
    error_log($_SESSION["userId"]);
    $teacher = new Teacher();
    $students = $teacher->getStudents($teacherid);

    $assTasks = new AssignedTask();
    $assignedTasks = $assTasks->getAssTaskNames(4, null);

    $params = array("username"=>$_SESSION['userName'], "students"=>$students, "tasks"=>$assignedTasks);
    $app->render("teacher/home.php", $params);
})->via('GET', 'POST')->name('home');

$app->get('/logout', function()use($app){
   if(isset($_SESSION["userId"]))
   {
     session_unset();
     $app->redirect($app->urlFor("login"));
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
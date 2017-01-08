<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
@mysql_connect("localhost","root","ashray");
mysql_select_db("oztinate_dev");
$basePath="http://".$_SERVER['HTTP_HOST']. '/oztinate_dev/';
$basepath_admin = $basePath."admin/";

include_once('functions.php');
//include_once('emailCls.php');
include('pnsCls.php');
include_once('userCls.php');
include_once('teacherCls.php');
include_once('ratingCls.php');
include_once('tabCls.php');
include_once('taskCls.php');
include_once('tagCls.php');
include_once('goalCls.php');
include_once('asstaskCls.php');
include_once('pns/pusher.php');

?>
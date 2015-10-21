<?php
session_start();
mysql_connect("localhost","root","");
mysql_select_db("oztinate");
$basePath="http://".$_SERVER['HTTP_HOST']. '/oztinate/';
$basepath_admin = $basePath."admin/";

include_once('functions.php');
include_once('userCls.php');
include_once('tabCls.php');
include_once('taskCls.php');
include_once('asstaskCls.php');

?>
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
@mysql_connect("localhost","root","2e7i8hl2VH");
mysql_select_db("bofypyis_oztinate_dev");
$basePath="http://".$_SERVER['HTTP_HOST']. '/oztinate_dev/';
$basepath_admin = $basePath."admin/";

include_once('functions.php');
//include_once('emailCls.php');
include('pnsCls.php');
include_once('userCls.php');
include_once('tabCls.php');
include_once('taskCls.php');
include_once('asstaskCls.php');
include_once('pns/pusher.php');

?>
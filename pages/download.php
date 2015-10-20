<?php
$path = $_GET['path'];
header('Content-Disposition: attachment; filename=' . basename($path));
readfile($path);
die;
?>
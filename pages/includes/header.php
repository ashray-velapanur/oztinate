<!DOCTYPE html>
<?php //include("src/functions.php");
$basePath="http://".$_SERVER['HTTP_HOST']. '/oztinate/';
$basepath_admin = $basePath."admin/";
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Oztinate Admin panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $basePath ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo $basePath ?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo $basePath ?>bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo $basePath ?>dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo $basePath ?>dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo $basePath ?>bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo $basePath ?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	.col-centered{
    text-align: center;
	}
	</style>
</head>

<body>

    <div id="wrapper">
<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Oztinate</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo $basepath_admin ?>profile"><i class="fa fa-user fa-fw"></i> Change Password</a>
                        </li>   
                        <li class="divider"></li>
                        <li><a href="<?php echo $basepath_admin ?>logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                        </li>
                        <li>
                            <a href="<?php echo $basepath_admin ?>asstasks?status=4"><i class="fa fa-dashboard fa-fw"></i> Assigned Exercises</a>
                        </li>
                        <li>
                            <a href="<?php echo $basepath_admin ?>tasks"><i class="fa fa-table fa-fw"></i> Exercises</a>
                        </li>
						<li>
                            <a href="<?php echo $basepath_admin ?>tabs"><i class="fa fa-music fa-fw"></i> Tablatures</a>
                        </li>  
                        <li>
                            <a href="<?php echo $basepath_admin ?>users"><i class="fa fa-user fa-fw"></i> Users</a>
                        </li>   
												
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
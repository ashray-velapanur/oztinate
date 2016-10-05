<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/teacherdashboard.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header">Create Exercise Template</h3>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <form role="form" method="post" action="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" name="taskName" type="text" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="email">Instruction</label>
                        <input class="form-control" name="instruction" type="text" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="minimumDuration">Minimim Duration</label>
                        <input class="form-control" name="minDuration" type="text" value="">
                    </div>
                    <div class="form-group">
                        <label for="practiceDuration">Practice Duration</label>
                        <input class="form-control" name="practiceDuration" type="text" value="">
                    </div>
                    <div class="form-group">
                        <label for="details">Details</label>
                        <input class="form-control" name="details" type="text" value="">
                    </div>
                    <input type="submit" value="Create" class="btn btn-lg btn-success btn-block"/>
                </form>
            </div>
        </div>
    </div>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>

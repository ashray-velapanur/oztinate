<!DOCTYPE html>
<html lang="en">

<?php include(ROOT_DIR."/pages/teacher/base.php") ?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Signup</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" name="name" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" name="email" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" name="password" type="password" value="">
                            </div>
                            <input type="submit" value="Signup" class="btn btn-lg btn-success btn-block"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>

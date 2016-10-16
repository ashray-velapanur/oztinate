<!DOCTYPE html>
<html lang="en">

<?php include(ROOT_DIR."/pages/teacher/base.php") ?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Invite Students</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="">
                            <!-- <fieldset> -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" name="email" type="text" autofocus>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="Send Invite" class="btn btn-lg btn-success btn-block"/>
                            <!-- </fieldset> -->
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

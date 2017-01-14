<!DOCTYPE html>
<html lang="en">

<?php include(ROOT_DIR."/pages/teacher/base.php") ?>

<body>
    <?php include(ROOT_DIR."/pages/teacher/nav.php") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="h3">Students</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="h3 pull-right">
                                            <form action="/oztinate_dev/invite">
                                                <button type="submit" class="btn">
                                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group">
                                <?php foreach($data["students"] as $student): ?>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="h5">
                                                <?php echo $student["username"]; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="h5">
                                                <?php echo $student["unreviewdCount"]; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="pull-right">
                                                <form action="/oztinate_dev/teacher/student_details">
                                                    <input class="hidden" name="userId" id="userId" value="<?php echo $student["userid"]; ?>">
                                                    <button type="submit" class="btn">
                                                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div>

    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

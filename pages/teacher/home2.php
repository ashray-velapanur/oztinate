<!DOCTYPE html>
<html lang="en">

<?php include(ROOT_DIR."/pages/teacher/base.php") ?>

<body>
    <?php include(ROOT_DIR."/pages/teacher/nav.php") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="h3">Exercises</div>
                            </div>
                            <div class="col-md-6">
                                <div class="h3 pull-right">
                                    <form action="/oztinate_dev/teacher/create_exercise">
                                        <button type="submit" class="btn">
                                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="list-group">
                        <?php foreach($data["tasks"] as $task): ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="h5">
                                        <?php echo $task["taskName"]; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="h5">
                                        <?php echo $task["userName"]; ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="pull-right">
                                        <form action="/oztinate_dev/teacher/review_exercise">
                                            <input class="hidden" name="taskId" id="taskId" value="<?php echo $task["id"]; ?>">
                                            <button type="submit" class="btn">
                                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
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
            <div class="col-md-3"></div>
            </div>
    </div>

    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

</body>


</html>

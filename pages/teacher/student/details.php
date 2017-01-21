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
                                <div class="h3">Goals</div>
                            </div>
                            <div class="col-md-6">
                                <div class="h3 pull-right">
                                    <form action="/oztinate_dev/students/<?php echo $data["userId"]; ?>/goals">
                                        <button type="submit" class="btn">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($data["goals"] != null) {?>
                        <ul class="list-group">
                            <?php foreach ($data["goals"] as $goal) {?>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="h4 pull-left">
                                                <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                                            </div>
                                            <div class="h4 pull-left">
                                                <?php echo $goal["name"]; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="h4 pull-left">
                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            </div>
                                            <div class="h4 pull-left">
                                                <?php echo $goal["rating"]; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-8"></div>
                                    </div>
                                    <div class="row vertical-center">
                                        <div class="col-md-12">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $goal["progress"]; ?>%;">
                                                    <div>
                                                        <?php echo $goal["totalDuration"]; ?>/<?php echo $goal["targetDuration"]; ?> hours
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <p><small>No Goals Assigned.</small></p>
                    <?php } ?>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="h3">Exercises</div>
                            </div>
                            <div class="col-md-6">
                                <div class="h3 pull-right">
                                    <form action="/oztinate_dev/students/<?php echo $data["userId"]; ?>/exercises">
                                        <button type="submit" class="btn">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($data["assignedTasks"] != null) {?>
                        <ul class="list-group">
                            <?php foreach ($data["assignedTasks"] as $task) {?>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="h5">
                                            <?php echo $task["taskName"]; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="h5">
                                            <?php echo $task["status"]; ?>
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
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <p><small>No Exercises Assigned.</small></p>
                    <?php } ?>
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

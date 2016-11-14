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
                        <div class="h3 pull-left">Goals</div>
                    </div>
                </div>
                <?php foreach ($data["goals"] as $goal) {?>
                <div class="row panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="h5 pull-left">
                                        <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                                    </div>
                                    <div class="h4 pull-left">
                                        <?php echo $goal["name"]; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="h5 pull-left">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </div>
                                    <div class="h4 pull-left">
                                        <?php echo $goal["rating"]; ?>
                                    </div>
                                </div>
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
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="h3 pull-left">Exercises</div>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-md-1"></div> -->
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col-md-6">Name</th>
                                    <th class="col-md-4">Status</th>
                                    <th class="col-md-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data["assignedTasks"] as $task) {?>
                                <tr>
                                    <td class="col-md-6">
                                        <div class="h5">
                                            <?php echo $task["taskName"]; ?>
                                        </div>
                                    </td>
                                    <td class="col-md-4">
                                        <div class="h5">
                                            <?php echo $task["status"]; ?>
                                        </div>
                                    </td>
                                    <td class="col-md-2">
                                        <div class="pull-right">
                                            <form action="/oztinate_dev/teacher/review_exercise">
                                                <input class="hidden" name="taskId" id="taskId" value="<?php echo $task["id"]; ?>">
                                                    <button type="submit" class="btn">
                                                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                                    </button>
                                            </form>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="col-md-1"></div> -->
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

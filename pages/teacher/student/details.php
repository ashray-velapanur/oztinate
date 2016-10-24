<!DOCTYPE html>
<html lang="en">

<?php include(ROOT_DIR."/pages/teacher/base.php") ?>

<body>
    <?php include(ROOT_DIR."/pages/teacher/nav.php") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <div class="h3 pull-left">Exercises</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Practice Time</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>15 Hours</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Practice Time</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>15 Hours</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Practice Time</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>15 Hours</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-10">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data["assignedTasks"] as $task) {?>
                                <tr>
                                    <td><?php echo $task["id"]; ?></td>
                                    <td><?php echo $task["taskName"]; ?></td>
                                    <td><?php echo $task["status"]; ?></td>
                                    <td>
                                        <form action="/oztinate_dev/teacher/review_exercise">
                                            <input class="hidden" name="taskId" id="taskId" value="<?php echo $task["id"]; ?>">
                                            <button type="submit" class="btn btn-primary">Review</button>
                                        </form>
                                    </td>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
            </div>
        </div>
    </div>

    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

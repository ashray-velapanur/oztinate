<!DOCTYPE html>
<html lang="en">

<?php include("base.php") ?>

<body>
    <div class="container">
        <div class="row" style="display: flex; align-items: center;">
            <div class="col-md-11">
                <h1>Oztinate</h1>
            </div>
            <div class="col-md-1">
                <form action="/oztinate_dev/teacher/logout">
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: center;">
            <div class="col-md-8">
                <h3>Exercise Details</h3>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-10">
                <div class="row"  style="text-align: center; height:200px;">
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
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
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
                        </table>
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

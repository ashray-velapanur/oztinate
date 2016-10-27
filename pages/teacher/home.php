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
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col-md-4">Name</th>
                                    <th class="col-md-4">Assigned To</th>
                                    <th class="col-md-2"></th>                                    
                                    <th class="col-md-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data["tasks"] as $task): ?>
                                <tr>
                                    <td class="col-md-4"><?php echo $task["taskName"]; ?></td>
                                    <td class="col-md-4"><?php echo $task["userName"]; ?></td>
                                    <td class="col-md-2"></td>
                                    <td class="col-md-2">
                                        <form action="/oztinate_dev/teacher/review_exercise">
                                            <input class="hidden" name="taskId" id="taskId" value="<?php echo $task["id"]; ?>">
                                            <button type="submit" class="btn btn-primary btn-block">Review</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="h3 pull-left">Students</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col-md-4">Name</th>
                                    <th class="col-md-2">Unreviewd</th>
                                    <th class="col-md-2"></th>
                                    <th class="col-md-2"></th>
                                    <th class="col-md-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data["students"] as $student): ?>
                                <tr>
                                    <td class="col-md-4">
                                        <div class="h5">
                                            <?php echo $student["username"]; ?>
                                        </div>
                                    </td>
                                    <td class="col-md-2">
                                        <div class="h5">
                                            <?php echo $student["unreviewdCount"]; ?>
                                        </div>
                                    </td>
                                    <td class="col-md-2">
                                        <form action="">
                                            <input class="hidden" name="userId" id="userId" value="<?php echo $student["userid"]; ?>">
                                            <button type="submit" class="btn btn-primary btn-block">Goals</button>
                                        </form>
                                    </td>
                                    <td class="col-md-2">
                                        <form action="/oztinate_dev/teacher/assign_exercise">
                                            <input class="hidden" name="userId" id="userId" value="<?php echo $student["userid"]; ?>">
                                            <button type="submit" class="btn btn-primary btn-block">Assign Exercise</button>
                                        </form>
                                    </td>
                                    <td class="col-md-2">
                                        <form action="/oztinate_dev/teacher/student_details">
                                            <input class="hidden" name="userId" id="userId" value="<?php echo $student["userid"]; ?>">
                                            <button type="submit" class="btn btn-primary btn-block">Details</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
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

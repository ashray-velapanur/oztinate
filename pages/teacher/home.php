<!DOCTYPE html>
<html lang="en">

<?php include("base.php") ?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="h1 pull-left">Oztinate</div>
                <div class="pull-right">
                    <a href="/oztinate_dev/teacher/logout" class="h3 pull-left">Logout</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <div class="h3 pull-left">Students</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <a href="/oztinate_dev/teacher/create_exercise" type="button" class="btn btn-block btn-primary">Exercises</a>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col-md-8">Name</th>
                                    <th class="col-md-2"></th>
                                    <th class="col-md-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data["students"] as $student): ?>
                                <tr>
                                    <td class="col-md-8"><?php echo $student["username"]; ?></td>
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

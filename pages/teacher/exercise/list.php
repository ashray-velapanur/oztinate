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
                <div class="row vertical-center">
                    <div class="col-md-2">
                        <div class="h3">Exercises</div>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <form action="/oztinate_dev/teacher/create_exercise">
                            <button type="submit" class="btn btn-primary btn-block">Create</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-md-2"></div> -->
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col-md-10">Name</th>
                                    <th class="col-md-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data["tasks"] as $task): ?>
                                <tr>
                                    <td class="col-md-8">
                                        <div class="h5">
                                            <?php echo $task["name"]; ?></td>
                                        </div>
                                    <td class="col-md-4">
                                        <div class="pull-right">
                                            <form action="/oztinate_dev/teacher/update_exercise">
                                                <input name="id" class="hidden" id="id" value="<?php echo $task['id']; ?>">
                                                <button type="submit" class="btn">
                                                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="col-md-2"></div> -->
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

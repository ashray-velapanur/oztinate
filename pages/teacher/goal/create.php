<!DOCTYPE html>
<html lang="en">

<?php include(ROOT_DIR."/pages/teacher/base.php") ?>

<body>
    <?php include(ROOT_DIR."/pages/teacher/nav.php") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="h3 page-header">Create Goals</div>
                    </div>
                </div>

                <form role="form" method="post" action="">
                    <input class="hidden" name="userId" id="userId" type="text" value="<?php echo $data["userId"];?>">
                    <div class="form-group">
                        <label for="exercise">Exercise</label>
                        <select name="exercise" id="exercise">
                            <?php foreach ($data["tasks"] as $task) { ?>
                                <option value=<?php echo $task["id"] ?>><?php echo $task["name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input class="form-control" name="duration" type="number" min="0">
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <input class="form-control" name="rating" type="number" min="1" max="5">
                    </div>
                    <input type="submit" value="Create" class="btn btn-lg btn-success btn-block"/>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>

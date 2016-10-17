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
                        <div class="h3 page-header">Create Exercise Template</div>
                    </div>
                </div>
                <form role="form" method="post" action="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" name="taskName" type="text" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="email">Instruction</label>
                        <textarea class="form-control" name="instruction" type="text" autofocus></textarea>
                    </div>
                    <div class="form-group">
                        <label for="minimumDuration">Minimim Duration</label>
                        <input class="form-control" name="minDuration" type="number" min="0" value="">
                    </div>
                    <div class="form-group">
                        <label for="practiceDuration">Practice Duration</label>
                        <input class="form-control" name="practiceDuration" type="number" min="0" value="">
                    </div>
                    <div class="form-group">
                        <label for="details">Details</label>
                        <input class="form-control" name="details" type="text" value="">
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

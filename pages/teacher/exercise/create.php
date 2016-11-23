<!DOCTYPE html>
<html lang="en">

<?php include(ROOT_DIR."/pages/teacher/base.php") ?>

<body>
    <?php include(ROOT_DIR."/pages/teacher/nav.php") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="h3">Exercise Templates</div>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="">
                            <div class="form-group">
                                <label for="template">Template</label>
                                <select name="template" id="template" onChange="updateTemplate(this)">
                                    <option value="newExercise">New Exercise</option>
                                    <?php foreach ($data["tasks"] as $task) { ?>
                                        <option value=<?php echo $task["id"] ?>><?php echo $task["name"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" id="taskName" name="taskName" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="email">Instruction</label>
                                <textarea class="form-control" name="instruction" id="instruction" type="text"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="minimumDuration">Minimim Duration</label>
                                <input class="form-control" name="minDuration" id="minDuration" type="number" min="0">
                            </div>
                            <div class="form-group">
                                <label for="practiceDuration">Practice Duration</label>
                                <input class="form-control" name="practiceDuration" id="practiceDuration" type="number" min="0">
                            </div>
                            <div class="form-group">
                                <label for="details">Details</label>
                                <input class="form-control" name="details" id="details" type="text">
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input class="form-control" name="tags" id="tags" type="text">
                            </div>
                            <input name="txtTaskId" id="txtTaskId" class="hidden">
                            <input type="submit" value="Save" class="btn btn-lg btn-success btn-block"/>
                        </form>

                    </div>
                </div>


            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script type="text/javascript">
        function updateTemplate(e) {
            var id = e.options[e.selectedIndex].value;

            $.get("/oztinate_dev/teacher/get_exercise", {"id": id}, function (data) {
                console.log(data);
                $("#txtTaskId").val(data["taskId"]);
                $("#taskName").val(data["taskName"]);
                $("#minDuration").val(data["minDuration"]);
                $("#practiceDuration").val(data["practiceDuration"]);
                $("#details").val(data["details"]);
                $("#instruction").val(data["instruction"]);
            });
        }
    </script>
</body>

</html>

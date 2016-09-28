<!DOCTYPE html>
<html lang="en">

<?php include("base.php") ?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Assign Exercise</h3>
                    </div>
                </div>
                <form role="form" method="post" action="">
                    <div class="form-group">
                        <label for="name">Template</label>
                        <select name="template" id="template" onChange="updateTemplate(this)">
                            <?php foreach ($data["tasks"] as $task) { ?>
                                <option value=<?php echo $task["id"] ?>><?php echo $task["name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                <input class="hidden" name="userId" id="userId" type="text" value="<?php echo $data["userId"];?>">
                <div class="form-group">
                    <label for="taskId">Id</label>
                    <input class="form-control" name="taskId" id="taskId" type="text" autofocus>
                </div>
                <div class="form-group">
                    <label for="taskName">Name</label>
                    <input class="form-control" name="taskName" id="taskName" type="text" autofocus>
                </div>
                <div class="form-group">
                    <label for="email">Instruction</label>
                    <input class="form-control" name="instruction" id="instruction" type="text" autofocus>
                </div>
                <div class="form-group">
                    <label for="minDuration">Minimim Duration</label>
                    <input class="form-control" name="minDuration" id="minDuration" type="text" value="">
                </div>
                <div class="form-group">
                    <label for="practiceDuration">Practice Duration</label>
                    <input class="form-control" name="practiceDuration" id="practiceDuration" type="text" value="">
                </div>
                <div class="form-group">
                    <label for="details">Details</label>
                    <input class="form-control" name="details" id="details" type="text" value="">
                </div>
                <div class="form-group">
                    <label for="dateOfCompletion">Deadline</label>
                    <input class="form-control" id="dateOfCompletion" name="dateOfCompletion" <?php if(isset($assTask["completionDate"])){ echo 'value="'.date("m/d/Y",strtotime($assTask["completionDate"])).'"';} ?> required/>
                </div>
                <input type="submit" value="Assign" class="btn btn-lg btn-success btn-block"/>
                </form>
            </div>
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
                $("#taskId").val(data["taskId"]);
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

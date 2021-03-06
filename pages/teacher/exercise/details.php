<!DOCTYPE html>
<html lang="en">

<?php include(ROOT_DIR."/pages/teacher/base.php") ?>

<body>
    <?php include(ROOT_DIR."/pages/teacher/nav.php") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="h3">Exercise Detail</div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">Name</label>
                                <div class="name">
                                    <div class="h5">
                                        <?php echo $task['taskName'] ?>
                                    </div>
                                </div>
                                <label for="minDuration">Minimum Duration</label>
                                <div class="minDuration">
                                    <div class="h5">
                                        <?php echo $task['minDuration'] ?> minutes
                                    </div>
                                </div>
                                <label for="practiceDuration">Practice Duration</label>
                                <div class="practiceDuration">
                                    <div class="h5">
                                        <?php echo $task['practiceDuration'] ?>  minutes
                                    </div>
                                </div>
                                <label for="assignedDate">Assigned Date</label>
                                <div class="assignedDate">
                                    <div class="h5">
                                        <?php echo $task['assignedDate'] ?>
                                    </div>
                                </div>
                                <label for="completionDate">Completion Date</label>
                                <div class="completionDate">
                                    <div class="h5">
                                        <?php echo $task['completionDate'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="clips">Clips</label>
                                    <div class="clips">
                                        <?php foreach ($data["clips"] as $clip) { ?>
                                            <audio src=<?php echo $clip ?> controls></audio>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="comments">Comments</label>
                                    <div id="comments" name="comments">
                                        <?php foreach ($data["comments"] as $comment) { ?>
                                        <div class="panel">
                                            <h5><?php echo $comment ?></h5>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <form role="form" method="post" action="/oztinate_dev/admin/addComment">
                                    <div class="form-group">
                                        <input class="hidden" name="assTaskId" id="assTaskId" value="<?php echo $data["task"]["Id"]; ?>">
                                        <input class="hidden" name="userId" id="userId" value="3">
                                        <textarea id="comment" name="comment" class="form-control" rows="3"></textarea>
                                        <!-- <input type="submit" value="Add Comment" class="btn btn-md btn-success pull-right"/> -->
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-md btn-success pull-right">Add Comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>

    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

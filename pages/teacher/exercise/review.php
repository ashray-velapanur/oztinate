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
                <div class="row">
                    <div class="col-md-12  page-header">
                        <div class="h3 pull-left">Review Exercise</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="clips">Clips</label>
                            <div classs="clips">
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
                                <button type="submit" class="btn btn-md btn-success pull-right">Add Comment</button>
                                <!-- <input type="submit" value="Add Comment" class="btn btn-md btn-success pull-right"/> -->
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" method="post" action="">
                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <input class="hidden" name="assTaskId" id="assTaskId" value="<?php echo $data["task"]["Id"]; ?>">
                                <select class="form-control" name="rating" id="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <button type="submit" class="btn btn-md btn-success pull-right">Rate</button>
                            </div>
                        </form>
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

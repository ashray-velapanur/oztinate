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
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="row" style="display: flex; align-items: center;">
                    <div class="col-md-12 pull-left">
                        <h2 class="page-header">Review Exercise</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="clips">Clips</label>
                            <div classs="clips">
                                <audio src="horse.ogg" controls></audio>
                                <audio src="horse.ogg" controls></audio>
                                <audio src="horse.ogg" controls></audio>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="comments">Comments</label>
                            <div id="comments" name="comments">
                                <div class="panel">
                                    <h5>This is a comment</h5>
                                </div>
                                <div class="panel">
                                    <h5>This is a comment too</h5>
                                </div>
                            </div>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Comment" class="btn btn-md btn-success pull-right"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <h2 class="rating">☆☆☆☆☆</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" value="Submit" class="btn btn-lg btn-success btn-block"/>
                    </div>
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

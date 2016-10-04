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
        <div class="row" style="display: flex; align-items: center;">
            <div class="col-md-8">
                <h3>Exercise Details</h3>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-10">
                <div class="row"  style="text-align: center; height:200px;">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Practice Time</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>15 Hours</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Practice Time</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>15 Hours</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Practice Time</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>15 Hours</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>Master of Puppets Solo</td>
                                <td>
                                    <h5>Open</h5>
                                </td>
                                <td>
                                    <form action="/oztinate_dev/teacher/review_exercise">
                                        <button type="submit" class="btn btn-primary">Review</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Master of Puppets Solo</td>
                                <td>
                                    <h5>Open</h5>
                                </td>
                                <td>
                                    <form action="/oztinate_dev/teacher/review_exercise">
                                        <button type="submit" class="btn btn-primary">Review</button>
                                    </form>
                                </td>
                            </tr>
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

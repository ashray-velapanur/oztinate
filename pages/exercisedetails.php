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
            <div class="col-md-12">
        		<table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Clips</th>
                        <th>Status</th>
                        <th>Rating</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>Master of Puppets Solo</td>
                        <td>
                            <button class="btn btn-primary">Play</button>
                        </td>
                        <td>
                            <select>
                                <option>Open</option>
                                <option>Not Reviewed</option>
                                <option>Reviewed</option>
                            </select>
                        </td>
                        <td>
                            <select>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-primary">Update</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Master of Puppets Intro</td>
                        <td>
                            <button class="btn btn-primary">Play</button>
                        </td>
                        <td>
                            <select>
                                <option>Open</option>
                                <option>Not Reviewed</option>
                                <option>Reviewed</option>
                            </select>
                        </td>
                        <td>
                            <select>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-primary">Update</button>
                        </td>
                    </tr>
            	</table>
            </div>
    </div>

    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

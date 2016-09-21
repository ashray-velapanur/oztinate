<!DOCTYPE html>
<html lang="en">

<?php include("base.php") ?>

<body>
    <div class="container">
        <div class="row" style="display: flex; align-items: center;">
            <div class="col-md-12">
                <h1 class="page-header">Oztinate</h1>
            </div>
        </div>
        <div class="row" style="display: flex; align-items: center;">
            <div class="col-md-8">
                <h3>Students</h3>
            </div>
            <div class="col-md-8">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary">Button 1</button>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary">Button 1</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
        		<table class="table">
            		<tr>
            			<th>Name</th>
                        <th>Name</th>
                        <th>Name</th>
            			<th>Password</th>
            		</tr>
				    <?php foreach($data["students"] as $student): ?>
				    <tr>
				        <td><?php echo $student; ?></td>
                        <td><?php echo $student; ?></td>
                        <td><?php echo $student; ?></td>
				        <td>pass</td>
				    </tr>
				    <?php endforeach; ?>
            	</table>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>

    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
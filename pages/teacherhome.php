<!DOCTYPE html>
<html lang="en">

<?php include("base.php") ?>

<body>
Logged in as <?php echo $data['username']; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
        		<table>
            		<tr>
            			<th>Name</th>
            			<th>Password</th>
            		</tr>
				    <?php foreach($data["students"] as $student): ?>
				    <tr>
				        <td><?php echo $student; ?></td>
				        <td>pass</td>
				    </tr>
				    <?php endforeach; ?>
            	</table>
            </div>
        </div>
    </div>

    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

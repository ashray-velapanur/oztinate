<?php include("includes/header.php") ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<div style="margin-bottom: -20px; margin-top: 20px;">
					<?php if($status==1) {?>
						<div  class="alert alert-success">Exercise deleted successfully..!!!</div>
					<?php } else if($status==2) {?>	
						<div class="alert alert-danger">Error...!!! Exercise can't delete</div>
					<?php } else if($status==3) {?>	
						<div class="alert alert-danger">Sorry...!!! Exercise is assigned to a user</div>
					<?php } ?>	

					</div>
					<a href="<?php echo $basepath_admin ?>addtask" style="margin-top:30px" class="pull-right btn btn-primary">Add New Exercise</a>
                    <h1 class="page-header">Exercises</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                        <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#Id</th>
                                            <th>Exercise Name</th>
                                            <th>Min Duration(In Minutes)</th>
                                            <th>Practice Duration(In Minutes)</th>
											<th>Details</th>
											<th>Created at</th>
											<th>Edit</th>
											<th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php while($row= mysql_fetch_array($tasks)){?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row["taskId"] ?></td>
                                            <td><?php echo $row["taskName"] ?></td>
                                            <td><?php echo $row["minDuration"] ?></td>
											<td><?php echo $row["practiceDuration"] ?></td>
											<td><?php echo $row["details"] ?></td>
											<td><?php echo $row["createdDate"] ?></td>
                                            <td class="center">Edit</td>
                                            <td class="center"><a onClick="return confirm('Are you sure you want to delete this Task?')" href="<?php echo $basepath_admin."deletetask/".$row["taskId"] ?>" style="text-decoration:none;"><i class="fa fa-trash fa-fw"></i></a></td>
                                        </tr>
										<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript 
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <!--<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>-->

</body>

</html>

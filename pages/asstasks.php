<?php include("includes/header.php") ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<div style="margin-bottom: -20px; margin-top: 20px;">
					<?php if($status==1) {?>
						<div  class="alert alert-success">Exercise Assignment deleted successfully..!!!</div>
					<?php } else if($status==2) {?>	
						<div class="alert alert-danger">Error...!!! Task Assignment can't delete</div>
					<?php } ?>	

					</div>
					<a href="<?php echo $basepath_admin ?>addasstask" style="margin-top:30px" class="pull-right btn btn-primary">Assign Exercise</a>
                    <h1 class="page-header">Assigned Exercises</h1>
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
                                            <th>Assigned To</th>
                                            <th>Status</th>
											<th>Assigned Date</th>
											<th>Completion Date</th>
											<th>Edit</th>
											<th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php while($row= mysql_fetch_array($assTasks)){?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row["Id"] ?></td>
                                            <td><a href="viewasstask/<?php echo $row["Id"] ?>"><?php echo $row["taskName"] ?></a></td>
                                            <td><?php echo $row["userName"] ?></td>
											<td><?php echo getTaskStatus($row["status"]) ?></td>
											<td><?php echo $row["assignedDate"] ?></td>
											<td><?php echo $row["completionDate"] ?></td>
                                            <td class="center">Edit</td>
                                            <td class="center"><?php if($row["status"]==5 || $row["status"]==6) {?><a onClick="return confirm('Are you sure you want to delete this Task Assignment?')" href="<?php echo $basepath_admin."deleteasstask/".$row["Id"] ?>" style="text-decoration:none;"><i class="fa fa-trash fa-fw"></i></a><?php }?></td>
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
	<script type="text/javascript">
		//function()
	</script>
</body>

</html>

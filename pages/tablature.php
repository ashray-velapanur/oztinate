<?php include("includes/header.php") ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<div style="margin-bottom: -20px; margin-top: 20px;">
					<?php if($status==1) {?>
						<div  class="alert alert-success">Tablature deleted successfully..!!!</div>
					<?php } else if($status==2) {?>	
						<div class="alert alert-danger">Error...!!! Tablature can't delete</div>
					<?php } else if($status==3) {?>	
						<div class="alert alert-danger">Sorry...!!! Tablature is assigned to a task</div>
					<?php } ?>	

					</div>
					<a href="<?php echo $basepath_admin ?>addtab" style="margin-top:30px" class="pull-right btn btn-primary">Add New Tablature</a>
                    <h1 class="page-header">Tablatures</h1>
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
                                            <th>Tab Name</th>
                                            <th>Url</th>
                                            <th>Created at</th>
											<th>Edit</th>
											<th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php while($row= mysql_fetch_array($tabs)){?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $row["tabId"] ?></td>
                                            <td><?php echo $row["name"] ?></td>
                                            <td><a target="_blank" href="<?php echo $row["tabUrl"] ?>"><?php echo $row["tabUrl"] ?></a></td>
											<td><?php echo $row["createdDate"] ?></td>
											<td class="center">Edit</td>
                                            <td class="center"><a onClick="return confirm('Are you sure you want to delete this Tablature?')" href="<?php echo $basepath_admin."deletetab/".$row["tabId"] ?>" style="text-decoration:none;"><i class="fa fa-trash fa-fw"></i></a></td>
                                        </tr>
										<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <div class="col-sm-6"><div class="dataTables_length" id="dataTables-example_length"><?php echo $itemsPerPage; ?></div></div><div class="col-sm-6"><?php echo $pageNumbers; ?></div>
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

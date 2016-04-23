<?php include("includes/header.php") ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<div style="margin-bottom: -20px; margin-top: 20px;">
					<?php if($status==1) {?>
						<div  class="alert alert-success">Exercise deleted successfully..!!!</div>
					<?php } else if($status==2) {?>	
						<div class="alert alert-danger">Error...!!! Exercise can't delete</div>
					<?php } else if($status==3) {?>	
						<div class="alert alert-danger">Cannot delete. This exercise is assigned to many users and not yet completed or aborted</div>
					<?php } ?>	

					</div>
					<a href="<?php echo $basepath_admin ?>addtask" style="margin-top:30px" class="pull-right btn btn-primary">Add New Exercise</a>
                    <h1 class="page-header">Exercises</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form method="get" name="searchform">
                    <div class="col-sm-12">
                        <div id="dataTables-example_filter" class="dataTables_filter">
                            <label style="margin-right: 10px;"><input type="text" class="form-control input-sm" name="taskName" placeholder="Search task" <?php if(isset($_GET["taskName"])){ echo "value=".$_GET['taskName']; }?>  ></label>
                             <label style="margin-right: 5px; width: 100px;"><input type="text" class="form-control input-sm" name="dateFrom" id="dateFrom" placeholder="Date from" <?php if(isset($_GET["dateFrom"])){ echo "value=".$_GET['dateFrom']; }?>  ></label>
                            <label style="margin-right: 10px; width: 100px;"><input type="text" class="form-control input-sm" name="dateTo" id="dateTo" placeholder="Date to" <?php if(isset($_GET["dateTo"])){ echo "value=".$_GET['dateTo']; }?>  ></label>
                            <input type="submit" class="btn btn-sm btn-primary">
                             <a href="<?php echo $basepath_admin ?>tasks" type="button" class="btn btn-sm btn-danger">Clear</a>
                        </div>
                   </div>
               </form>
                <div class="col-lg-12">
                        <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#Id</th>
                                            <th><a href="<?php echo $sortString ?>taskName&<?php echo $sortMode ?>">Exercise Name</a></th>
                                            <th>Min Duration(In Minutes)</th>
                                            <th>Practice Duration(In Minutes)</th>
											<th>Details</th>
                                            <th><a href="<?php echo $sortString ?>createdUser&<?php echo $sortMode ?>">Created by</a></th>
											<th><a href="<?php echo $sortString ?>createdDate&<?php echo $sortMode ?>">Created at</a></th>
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
                                            <td><?php echo $row["createdUser"] ?></td>
											<td><?php echo $row["createdDate"] ?></td>
                                            <td class="center"><a href="<?php echo $basepath_admin."edittask/".$row["taskId"] ?>">Edit</a></td>
                                            <td class="center"><a onClick="return confirm('Are you sure you want to delete this Task?')" href="<?php echo $basepath_admin."deletetask/".$row["taskId"] ?>" style="text-decoration:none;"><i class="fa fa-trash fa-fw"></i></a></td>
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
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script type="text/javascript">
        //function()

        $(function () {
            $("#dateFrom").datepicker();
             $("#dateTo").datepicker();
            /*{
                changeMonth: true,
                changeYear: true,
                yearRange: "1900:2015",
                dateFormat: "yy-mm-dd",
                defaultDate: '1900-01-01'
            }*/
        });
    </script>

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

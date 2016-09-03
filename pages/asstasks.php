<?php include("includes/header.php") ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
                <form method="get" name="searchform">
                    <div class="col-sm-12">
                        <div id="dataTables-example_filter" class="dataTables_filter">
                            <label style="margin-right: 10px;"><input type="text" class="form-control input-sm" name="userName" placeholder="Search user name" <?php if(isset($_GET["userName"])){ echo "value=".$_GET['userName']; }?>  ></label>
                            <label style="margin-right: 30px;">
                                <select type="search" name="status" class="form-control input-sm">
                                    <option value="-1">Choose Status</option><option value="0">Open</option>
                                    <option <?php if(isset($_GET["status"])){if($_GET["status"]=="1") {echo 'selected="selected"'; }}?> value="1">Reopen</option>
                                    <option <?php if(isset($_GET["status"])){if($_GET["status"]=="3") {echo 'selected="selected"'; }}?> value="3">ReadyForReviewButUploadPending</option>
                                    <option <?php if(isset($_GET["status"])){if($_GET["status"]=="4") {echo 'selected="selected"'; }}?> value="4">ReadyForReview</option>
                                    <option <?php if(isset($_GET["status"])){if($_GET["status"]=="5") {echo 'selected="selected"'; }}?>value="5">Completed</option>
                                    <option <?php if(isset($_GET["status"])){if($_GET["status"]=="6") {echo 'selected="selected"'; }}?>value="6">Aborted</option>
                                </select>
                            </label>
                            <label style="margin-right: 0px;">
                                <select type="search" name="date_type" class="form-control input-sm">
                                     <option value="0">Assigned date</option>
                                      <option <?php if(isset($_GET["date_type"])&&$_GET["date_type"]==1) echo "selected=selected" ?> value="1">Deadline</option>
                                </select>
                            </label>    
                            <label style="margin-right: 5px; width: 100px;"><input type="text" class="form-control input-sm" name="dateFrom" id="dateFrom" placeholder="Date from" <?php if(isset($_GET["dateFrom"])){ echo "value=".$_GET['dateFrom']; }?>  ></label>
                            <label style="margin-right: 10px; width: 100px;"><input type="text" class="form-control input-sm" name="dateTo" id="dateTo" placeholder="Date to" <?php if(isset($_GET["dateTo"])){ echo "value=".$_GET['dateTo']; }?>  ></label>
                            <input type="submit" class="btn btn-sm btn-primary">
                             <a href="<?php echo $basepath_admin ?>asstasks" type="button" class="btn btn-sm btn-danger">Clear</a>
                        </div>
                   </div>
               </form>

                <div class="col-lg-12">
                        <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#Id</th>
                                            <th>Exercise Name</th>
                                            <th><a href="<?php echo $sortString ?>userName&<?php echo $sortMode ?>">Assigned To</a></th>
                                            <th> <a href="<?php echo $sortString ?>status&<?php echo $sortMode ?>">Status</a></th>
											<th> <a href="<?php echo $sortString ?>assignedDate&<?php echo $sortMode ?>">Assigned Date</a></th>
											<th> <a href="<?php echo $sortString ?>completionDate&<?php echo $sortMode ?>">Deadline</a></th>
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
                                            <td class="center"><?php if($row["status"]<2){?> <a href="<?php echo $basepath_admin."editasstask/".$row["Id"] ?>">Edit</a> <?php } ?></td>
                                            <td class="center"><?php if($row["status"]==5 || $row["status"]==6) {?><a onClick="return confirm('Are you sure you want to delete this Task Assignment?')" href="<?php echo $basepath_admin."deleteasstask/".$row["Id"] ?>" style="text-decoration:none;"><i class="fa fa-trash fa-fw"></i></a><?php }?></td>
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
</body>

</html>

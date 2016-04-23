<?php include("includes/header.php") ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
                <form method="get" name="searchform">
                    <div class="col-sm-12">
                        <div id="dataTables-example_filter" class="dataTables_filter">
                            <label style="margin-right: 10px;"><input type="text" class="form-control input-sm" name="name" placeholder="Search tabs" <?php if(isset($_GET["name"])){ echo "value=".$_GET['name']; }?>  ></label>
                             <label style="margin-right: 5px; width: 100px;"><input type="text" class="form-control input-sm" name="dateFrom" id="dateFrom" placeholder="Date from" <?php if(isset($_GET["dateFrom"])){ echo "value=".$_GET['dateFrom']; }?>  ></label>
                            <label style="margin-right: 10px; width: 100px;"><input type="text" class="form-control input-sm" name="dateTo" id="dateTo" placeholder="Date to" <?php if(isset($_GET["dateTo"])){ echo "value=".$_GET['dateTo']; }?>  ></label>
                            <input type="submit" class="btn btn-sm btn-primary">
                             <a href="<?php echo $basepath_admin ?>tabs" type="button" class="btn btn-sm btn-danger">Clear</a>
                        </div>
                   </div>
               </form>
                <div class="col-lg-12">
                        <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#Id</th>
                                            <th><a href="<?php echo $sortString ?>name&<?php echo $sortMode ?>">Tab Name</a></th>
                                            <th>Url</th>
                                            <th><a href="<?php echo $sortString ?>createdUser&<?php echo $sortMode ?>">Created by</a></th>
                                            <th><a href="<?php echo $sortString ?>createdDate&<?php echo $sortMode ?>">Created at</a></th>
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
											<td><?php echo $row["createdUser"] ?></td>
                                            <td><?php echo $row["createdDate"] ?></td>
											<td class="center"><a href="<?php echo $basepath_admin.'edittab/'.$row['tabId'] ?>">Edit</a></td>
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

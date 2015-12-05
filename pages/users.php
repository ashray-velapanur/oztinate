<?php include("includes/header.php") ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<div style="margin-bottom: -20px; margin-top: 20px;">
					<?php if($status==1) {?>
						<div  class="alert alert-success">User deleted successfully..!!!</div>
					<?php } else if($status==2) {?>	
						<div class="alert alert-danger">Error...!!! User can't delete</div>
					<?php } else if($status==3) {?>	
						<div class="alert alert-danger">Sorry...!!! You can't delete the superadmin user</div>
					<?php } else if($status==4) {?>	
						<div class="alert alert-danger">Sorry...!!! User is assigned to a task</div>
					<?php } ?>	

					</div>
					<a href="<?php echo $basepath_admin ?>adduser" style="margin-top:30px" class="pull-right btn btn-primary">Add New User</a>
                    <h1 class="page-header">Users</h1>
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
                                            <th>User Name</th>
                                            <th>User Type</th>
											<th>Reset Password</th>
											<th>Created at</th>
											<th>Edit</th>
											<th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php while($row= mysql_fetch_array($users)){?>
                                        <tr class="odd gradeX">
											<td><?php echo $row["userId"] ?></td>
                                            <td><?php echo $row["userName"] ?></td>
                                            <td><?php if($row["userType"]=="0"||$row["userType"]=="1"){echo "Administrator";}else{echo "User";} ?></td>
											 <td><?php if($row["userType"]=="2"){?> <a id="password-reset-<?php echo  $row['userId'] ?>" type="button" onClick="return resetPassword(<?php echo $row['userId'] ?>)" href="#" data-loading-text="Generating Password...">Reset Password</a> <?php }?></td>
                                           	<td><?php echo $row["createdDate"] ?></td>
                                            <td class="center">Edit</td>
                                            <td class="center"><a onClick="return confirm('Are you sure you want to delete this User?')" href="<?php echo $basepath_admin."deleteuser/".$row["userId"] ?>" style="text-decoration:none;" data-method="destroy"><i class="fa fa-trash fa-fw"></i></a> </td>
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
	
    <script>
		<?php echo "var basepath='".$basepath_admin."';";  ?>
		function resetPassword(userId)
		{
			$.ajax({
				  method: "POST",
				  url: basepath+"resetUserPassword",
				  data: {userId:userId},
				  beforeSend: function(){
					 // Handle the beforeSend event
					 //alert("asdas");
					  var $this = $("#password-reset-"+userId);
						$this.button('loading');  
				   }	  
				}).done(function(data){
						var data  = eval('(' + data + ')');
						var $this = $("#password-reset-"+userId);
						$("#password-reset-"+userId).text(data.message);  
					});
			//alert(userId);
		}
    /*$(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });*/
    </script>

</body>

</html>

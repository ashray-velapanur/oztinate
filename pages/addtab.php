<?php include("includes/header.php") ?>
    <!-- jQuery -->
 <script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
	<?php echo "var basepath='".$basepath_admin."';"; ?>

	function validateSubmit()
	{
		if($('[name="tabName"]').parent('div').hasClass('has-error'))
		{
			alert("Tablature is already Exist");
			return false;
		}
		return true;
	}
	// put all your jQuery goodness in here.
	function checkTabExist(){
	
		inputTabName = $('[name="tabName"]');
		var tabName = inputTabName.val();
				
				$.ajax({
				  method: "POST",
				  url: basepath+"checkTabExist",
				  data: {tabName:tabName}
				})
				  .done(function( msg ) {
					if(msg=="true")
					{
						inputTabName.parent('div').addClass('has-error');
						inputTabName.prev('label').show();
		
					}
					else{
					
						inputTabName.parent('div').removeClass('has-error');
						inputTabName.prev('label').hide();
					}
				  });
		}

	
</script>

	
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ADD TABLATURE</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
							
                            <div class="row">
                                <div class="col-lg-6">
									<?php if($status=="Success") {?>
										<div class="alert alert-success">New Tablature Added Successfully..!!!</div>
									<?php } else if($status=="Error") {?>	
										<div class="alert alert-danger">Error...!!! Tablature is not added</div>
									<?php } else if($status=="Exist") {?>	
										<div class="alert alert-danger">Error...!!! Tablature is already exist</div>
									<?php } else if($status=="invalidImage") {?>	
										<div class="alert alert-danger">Error...!!! Uploaded file is not an image</div>
									<?php } ?>	
									
                                    <form role="form" method="post" onsubmit="return validateSubmit();" enctype="multipart/form-data">
                                        <div id="divTabName" class="form-group">
                                            <label>Tablature Name</label></br>
											<label class="control-label" hidden for="inputError">This Tablature is already exist</label>
                                            <input class="form-control" onblur="checkTabExist();" name="tabName" required>
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Tablature File</label>
                                            <input type ="file" class="form-control" name="tabFile" />
                                        </div>
										<div class="row">
											
											<div class="col-lg-6">
												<div class="form-group col-centered">
													<button type="submit"   href="addtask" style="width:160px" class="btn btn-primary">Save</button>		
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group col-centered">
													<a href="tasks" style="width:160px" class="btn btn-danger">cancel</a>		
												</div>
											</div>	
																						
											
										</div>
                                    </form>
                                </div>
								
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                    </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	
</body>

</html>
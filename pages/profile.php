<?php include("includes/header.php") ?>
    <!-- jQuery -->
 <script src="<?php echo $basePath ?>bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
	<?php echo "var basepath='".$basepath_admin."';"; ?>

	function validateSubmit()
	{
		

		if($("#newPassword").val()!=$("#newPasswordRe").val())
		{
			alert("Current password and new password are not same");
			return false;
		}

		return true;
	}
	
</script>

	
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">CHNAGE PASSWORD</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
							
                            <div class="row">
                                <div class="col-lg-6">
									<?php if($status["status"]=="Success"){ ?>
										<div class="alert alert-success"><?php echo $status["message"]; ?></div>		
									<?php }else if($status["status"]=="Error"){?>
										<div class="alert alert-danger"><?php echo $status["message"]; ?></div>
									<?php } ?>
									
                                    <form role="form" method="post" onsubmit="return validateSubmit();" enctype="multipart/form-data">
                                      <?php if(!$_SESSION["hackMode"]) {?>
                                        <div id="divCurrentPassword" class="form-group">
                                            <label>Current Password</label></br>
											<input type="password" class="form-control" name="currentPassword" id="currentPassword"onblur="checkTabExist();" required >
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <?php } ?>

                                         <div id="divNewPassword" class="form-group">
                                            <label>New password</label></br>
											<input type="password" class="form-control" name="newPassword" id="newPassword"onblur="checkTabExist();" required  >
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>

                                         <div id="divNewPasswordRe" class="form-group">
                                            <label>Re enter new password</label></br>
											<input type="password" class="form-control" name="newPasswordRe" id="newPasswordRe" onblur="checkTabExist();" required  >
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>

										<div class="row">
											
											<div class="col-lg-6">
												<div class="form-group col-centered">
													<button type="submit" style="width:160px" class="btn btn-primary">Change Password</button>		
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group col-centered">
													<a href="<?php echo $basepath_admin ?>asstasks" style="width:160px" class="btn btn-danger">cancel</a>		
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
    <script src="<?php echo $basePath ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo $basePath ?>bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo $basePath ?>dist/js/sb-admin-2.js"></script>
	
</body>

</html>
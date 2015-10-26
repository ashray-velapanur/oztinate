<?php include("includes/header.php") ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ASSIGN EXERCISE</h1>
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
									
									
                                    <form role="form" method="post">
										<input type="hidden" name="txtAssTaskId" value="<?php if(isset($assTask["Id"])){ echo $assTask["Id"]; $submitButton = "Update"; }else{ echo "0"; $submitButton = "Save";} ?>" />
                                        <div class="form-group">
                                            <label>Choose Exercise</label>
                                            <select <?php if(isset($assTask["taskId"])){ echo "disabled='disabled'"; }else{$assTask["taskId"]="";} ?> class="form-control" name="taskId" required>
													<?php while($row=mysql_fetch_array($tasks)){?>
														<option <?php if($assTask["taskId"]==$row["taskId"]) {echo 'selected="selected"'; }?> value="<?php echo $row["taskId"] ?>"><?php echo $row["taskName"] ?></option>
													<?php } ?>
											</select>
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <div class="form-group">
                                            <label>Choose User</label>
                                             <select <?php if(isset($assTask["userId"])){ echo "disabled='disabled'"; }else{$assTask["userId"]="";} ?> class="form-control" name="userId" required>
													<?php while($row=mysql_fetch_array($users)){?>
														<option <?php if($assTask["userId"]==$row["userId"]) {echo 'selected="selected"'; }?> value="<?php echo $row["userId"] ?>"><?php echo $row["userName"] ?></option>
													<?php } ?>
											</select>
                                        </div>
										<div class="form-group">
											<label>Completion Date</label>
											<input class="form-control" id="dateOfCompletion" name="dateOfCompletion" <?php if(isset($assTask["completionDate"])){ echo 'value="'.date("m/d/Y",strtotime($assTask["completionDate"])).'"';} ?> required/>
										</div>
																						
										<div class="row">
											
											<div class="col-lg-6">
												<div class="form-group col-centered">
													<button type="submit" href="addtask" style="width:160px" class="btn btn-primary"><?php echo $submitButton; ?></button>		
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group col-centered">
													<a href="asstasks" style="width:160px" class="btn btn-danger">cancel</a>		
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

    <!-- jQuery -->
    <script src="<?php echo $basePath ?>bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $basePath ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo $basePath ?>bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo $basePath ?>dist/js/sb-admin-2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(function () {
            $("#dateOfCompletion").datepicker();
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
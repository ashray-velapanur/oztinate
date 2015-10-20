<?php include("includes/header.php") ?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ADD EXERCISE</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
							
                            <div class="row">
                                <div class="col-lg-6">
									<?php if($status=="Success") {?>
										<div class="alert alert-success">New Exercise Added Successfully..!!!</div>
									<?php } else if($status=="Error") {?>	
										<div class="alert alert-danger">Error...!!! Exercise is not added</div>
									<?php } else if($status=="Exist") {?>	
										<div class="alert alert-danger">Error...!!! Exercise is already exist</div>
									<?php } ?>	
                                    <form role="form" method="post" onsubmit="return validateSubmit();">
                                        <div class="form-group">
                                            <label>Exercise Name</label></br>   
											<label class="control-label" hidden for="inputError">This Exercise is already exist</label>                                        
										   <input class="form-control" onblur="checkTabExist();" name="taskName" required>
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <div class="form-group">
                                            <label>Instruction</label>
                                            <textarea class="form-control" name="instruction" placeholder="Enter text"/></textarea>
                                        </div>
										<div class="row">
											<div class="col-lg-6">											
												<div class="form-group">
													<label>Practice Duration(In Minutes)</label>
													<select class="form-control" name="practiceDuration"  required>
														<option value="5">5</option>
														<option value="10">10</option>
														<option value="15">15</option>
														<option value="20">20</option>
														<option value="30">30</option>
													</select>	
												</div>
											</div>	
											<div class="col-lg-6">
												<div class="form-group">
													<label>Minimum Duration(In Minutes)</label>
													<select class="form-control" name="minDuration" required>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
													</select>
												</div>
											</div>
										</div>	
										<div class="form-group">
                                            <label>Details</label>
                                            <textarea class="form-control" name="details" placeholder="Enter text"/></textarea>
                                        </div>
										<input name="tabIds" id="tabIds" type="hidden"/>
										<div class="row">
											
											<div class="col-lg-6">
												<div class="form-group col-centered">
													<button type="submit" href="addtask" style="width:160px" class="btn btn-primary">Save</button>		
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
								<div class="col-lg-6">
									 <div class="form-group">
                                            <label>Choose Tablatures</label>
											<div class="row">
												<div class="col-lg-8">
													<select class="form-control" id="tabs" name="tabs" >
														<?php $tabList = array(); $i=0; while($row=mysql_fetch_array($tabs)){ array_push($tabList,$row); ?>
															<option value="<?php echo $i ?>"><?php echo $row["name"] ?></option>
														<?php $i++; } ?>	
													</select>
												</div>
												<div class="col-lg-4">												
													<input type="button" onClick="fillTableROw();" class="btn btn-primary" value="Add Tablature"/>
												</div>	
											</div>	
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                     </div>	
									 <div class="panel panel-default">
										<div class="panel-heading">
											Tablatures
										</div>
										<!-- /.panel-heading -->
										<div class="panel-body">
											<div class="table-responsive">
												<table id="tabListTbl" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>#</th>
															<th>Tablature Name</th>
															<th>Tablature Image</th>
															<th>Created Date</th>
														</tr>
													</thead>
													<tbody>
														
														
													</tbody>
												</table>
											</div>
											<!-- /.table-responsive -->
										</div>
										<!-- /.panel-body -->
									</div>
									 
								</div>
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
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	
	<script type='text/javascript'>
		<?php $js_array = json_encode($tabList);
		echo "var tabs=". $js_array . ";\n";
		echo "var basepath='".$basepath_admin."';";		?>
		console.log(tabs[0]);
		
		function fillTableROw()
		{
			var i=$("#tabs").val();
			$('#tabListTbl tr:last').after('<tr><td>'+tabs[i]["tabId"]+'</td><td>'+tabs[i]["name"]+'</td><td></td><td>'+tabs[i]["createdDate"]+'</td></tr>');
			$("#tabs option[value="+i+"]").remove();
			var tabIds=$("#tabIds").val()+","+tabs[i]["tabId"];
			$("#tabIds").val(tabIds);
		}
		
		function validateSubmit()
		{
			if($('[name="taskName"]').parent('div').hasClass('has-error'))
			{
				alert("Exercise is already Exist");
				return false;
			}
			return true;
		}
	// put all your jQuery goodness in here.
	function checkTabExist(){
	
		inputTaskName = $('[name="taskName"]');
		var taskName = inputTaskName.val();
				
				$.ajax({
				  method: "POST",
				  url: basepath+"checkTaskExist",
				  data: {taskName:taskName}
				})
				  .done(function( msg ) {
					if(msg=="true")
					{
						inputTaskName.parent('div').addClass('has-error');
						inputTaskName.prev('label').show();
		
					}
					else{
					
						inputTaskName.parent('div').removeClass('has-error');
						inputTaskName.prev('label').hide();
					}
				  });
		}
		
	</script>
</body>

</html>
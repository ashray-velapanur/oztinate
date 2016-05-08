<?php 
include("includes/header.php");
 $tabIds="";
 if(!isset($isTaskAssigned))
 	$isTaskAssigned=false;
?>
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
                               <form role="form" method="post" onsubmit="return validateDuration();">
                                <div class="col-lg-6">
									<!--<?php if($status=="Success") {?>
										<div class="alert alert-success">New Exercise Added Successfully..!!!</div>
									<?php } else if($status=="Error") {?>	
										<div class="alert alert-danger">Error...!!! Exercise is not added</div>
									<?php } else if($status=="Exist") {?>	
										<div class="alert alert-danger">Error...!!! Exercise is already exist</div>
									<?php } ?> -->
									<?php if($status["status"]=="Success"){ ?>
										<div class="alert alert-success"><?php echo $status["message"]; ?></div>		
									<?php }else if($status["status"]=="Error"){?>
										<div class="alert alert-danger"><?php echo $status["message"]; ?></div>
									<?php }
										if($isTaskAssigned){ ?>
											<div class="alert alert-danger">This task is assigned to some one. So can you edit only few things</div>
										<?php }?>

									
                                 
                                    <input type="hidden" name="txtTaskId" value="<?php if(isset($task["taskId"])){ echo $task["taskId"]; $submitButton = "Update"; }else{ echo "0"; $submitButton = "Save";} ?>" />
                                        <div class="form-group">
                                            <label>Exercise Name</label></br>   
											<!--<label class="control-label" hidden for="inputError">This Exercise is already exist</label>                                        
										   <input class="form-control" onblur="checkTabExist();" value="<?php if(isset($task["taskName"])){ echo $task["taskName"]; } ?>" name="taskName" required> -->
										   <input class="form-control" value="<?php if(isset($task["taskName"])){ echo $task["taskName"]; } ?>" name="taskName" required>
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <div class="form-group">
                                            <label>Instruction</label>
                                            <textarea class="form-control" name="instruction" value="" placeholder="Enter text"/><?php if(isset($task["instruction"])){ echo $task["instruction"]; } ?></textarea>
                                        </div>
										<div class="row">
											<div class="col-lg-6">											
												<div class="form-group">
													<label>Practice Duration(In Minutes)</label>
													<select <?php if($isTaskAssigned){ echo "disabled='disabled'"; } ?> class="form-control" name="practiceDuration" id="practiceDuration" required>
														<option <?php if(isset($task["practiceDuration"])){if($task["practiceDuration"]=="2") {echo 'selected="selected"'; }}?> value="2">2 minutes</option>
														<option <?php if(isset($task["practiceDuration"])){if($task["practiceDuration"]=="4") {echo 'selected="selected"'; }}?> value="4">4 minutes</option>
														<option <?php if(isset($task["practiceDuration"])){if($task["practiceDuration"]=="6") {echo 'selected="selected"'; }}?> value="6">6 minutes</option>
														<option <?php if(isset($task["practiceDuration"])){if($task["practiceDuration"]=="8") {echo 'selected="selected"'; }}?> value="8">8 minutes</option>
														<option <?php if(isset($task["practiceDuration"])){if($task["practiceDuration"]=="10") {echo 'selected="selected"'; }}?> value="10">10 minutes</option>
														<option <?php if(isset($task["practiceDuration"])){if($task["practiceDuration"]=="20") {echo 'selected="selected"'; }}?> value="20">20 minutes</option>
														<option <?php if(isset($task["practiceDuration"])){if($task["practiceDuration"]=="30") {echo 'selected="selected"'; }}?> value="30">30 minutes</option>
														<option <?php if(isset($task["practiceDuration"])){if($task["practiceDuration"]=="40") {echo 'selected="selected"'; }}?> value="40">40 minutes</option>
														<option <?php if(isset($task["practiceDuration"])){if($task["practiceDuration"]=="60") {echo 'selected="selected"'; }}?> value="60">1 Hours</option>
														<option <?php if(isset($task["practiceDuration"])){if($task["practiceDuration"]=="90") {echo 'selected="selected"'; }}?> value="90">1 1/2 Hours</option>
														<option <?php if(isset($task["practiceDuration"])){if($task["practiceDuration"]=="120") {echo 'selected="selected"'; }}?> value="120">2 Hours</option>
													</select>	
												</div>
											</div>	
											<div class="col-lg-6">
												<div class="form-group">
													<label>Minimum Duration(In Minutes)</label>
													<select <?php if($isTaskAssigned){ echo "disabled='disabled'"; } ?> class="form-control"  id="minDuration" name="minDuration" required>
														<option <?php if(isset($task["minDuration"])){if($task["minDuration"]=="1") {echo 'selected="selected"'; }}?> value="1">1 minutes</option>
														<option <?php if(isset($task["minDuration"])){if($task["minDuration"]=="2") {echo 'selected="selected"'; }}?> value="2">2 minutes</option>
													</select>
												</div>
											</div>
										</div>	
										<!-- <div class="form-group">
                                            <label>Details</label>
                                            <textarea class="form-control" name="details" placeholder="Enter text" value=""/><?php if(isset($task["details"])){echo $task["details"];} ?></textarea>
                                        </div> -->
										
										<div class="row">
											
											<div class="col-lg-6">
												<div class="form-group col-centered">
													<button type="submit" href="addtask"  style="width:160px" class="btn btn-primary">Save</button>		
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group col-centered">
													<a href="<?php echo $basepath_admin ?>tasks" style="width:160px" class="btn btn-danger">cancel</a>		
												</div>
											</div>	
											
										</div>
                                   
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <?php //if(!$isTaskAssigned){ ?>
								<div class="col-lg-6">
									<?php if(!$isTaskAssigned){  ?>
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
                                     <?php } ?>
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
															<!-- <th>Created Date</th> -->
															<?php if(!$isTaskAssigned){  ?>
															<th>Delete</th>
															<?php }?>
														</tr>
														<?php 
														if(isset($taskTablatures)){
															while($tabRow=mysql_fetch_array($taskTablatures))
															{  $tabIds = $tabIds.",".$tabRow["tabId"]; ?>
															<tr  id="tr-<?php echo $tabRow["tabId"]; ?>">
																<td><?php echo $tabRow["tabId"]; ?></td>
																<td><?php echo $tabRow["name"]; ?></td>
																<td><?php echo $tabRow["tabUrl"]; ?></td>
																<!-- <td><?php echo $tabRow["createdDate"]; ?></td> -->
																<?php if(!$isTaskAssigned){  ?>
																	<td><a onClick="removeTableRow(<?php echo $tabRow["tabId"]; ?>)"><i class="fa fa-trash fa-fw"></i></a></td>
																<?php }?>
															</tr>

															<?php }
														}
														?>
													</thead>
													<tbody>
														
														
													</tbody>
												</table>
												<input name="tabIds" id="tabIds" value="<?php if(isset($tabIds)&&!$isTaskAssigned){ echo $tabIds;} ?>" type="hidden"/>
											</div>
											<!-- /.table-responsive -->
										</div>
										<!-- /.panel-body -->
									</div>
									 
								</div>
								 </form>
								<?php //} ?>
								
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
	
	<script type='text/javascript'>
		<?php $js_array = json_encode($tabList);
		echo "var tabs=". $js_array . ";\n";
		echo "var basepath='".$basepath_admin."';";		?>
		console.log(tabs[0]);
		//$i=0;

		function validateDuration()
		{
			if($("#practiceDuration").val()<$("#minDuration").val())
			{
				alert("Minimum duration should be less than or equal to practice duration");
				return false;
			}
			else
			{
				return true;
			}
		}	
		function fillTableROw()
		{
			var i=$("#tabs").val();
			$('#tabListTbl tr:last').after('<tr id="tr-'+tabs[i]["tabId"]+'"><td>'+tabs[i]["tabId"]+'</td><td>'+tabs[i]["name"]+'</td><td>'+tabs[i]["tabUrl"]+'</td><td><a onClick="removeTableRow('+tabs[i]["tabId"]+')"><i class="fa fa-trash fa-fw"></i></a></td></tr>');
			$("#tabs option[value="+i+"]").remove();
			var tabIds=$("#tabIds").val()+","+tabs[i]["tabId"];
			$("#tabIds").val(tabIds);
		}

		function removeTableRow(tabId)
		{
			$('table#tabListTbl tr#tr-'+tabId).remove();
			var tabIds = $("#tabIds").val();
			var isExist =tabIds.indexOf(tabId);
			var newTabIds;
			console.log(tabIds);
			if(isExist>=0)
			{
			
			newTabIds=	tabIds.replace(","+tabId,'');
			}
			console.log(newTabIds);
			$("#tabIds").val(newTabIds);
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
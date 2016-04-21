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
                                            <select <?php if(isset($assTask["taskId"])){ echo "disabled='disabled'"; }else{$assTask["taskId"]="";} ?> class="form-control" name="taskId" required onchange="getTaskDuration()" >
													<?php while($row=mysql_fetch_array($tasks)){?>
														<option <?php if($assTask["taskId"]==$row["taskId"]) {echo 'selected="selected"'; }?> value="<?php echo $row["taskId"] ?>"><?php echo $row["taskName"] ?></option>
													<?php } ?>
											</select>

                                            <label class="label label-success" id="msg-taskduration" style="display:none" >Getting Task Durations...</label>
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div> 
                                        <div class="row">
                                            <div class="col-lg-6">                                          
                                                <div class="form-group">
                                                    <label>Practice Duration</label>
                                                    <select <?php if(isset($assTask["practiceDuration"])){ echo "disabled='disabled'"; }else{$assTask["practiceDuration"]="";} ?> class="form-control" id="practiceDuration" name="practiceDuration"  required>
                                                        <option <?php if(isset($assTask["practiceDuration"])){if($assTask["practiceDuration"]=="2") {echo 'selected="selected"'; }}?> value="2">2 Minutes</option>
                                                        <option <?php if(isset($assTask["practiceDuration"])){if($assTask["practiceDuration"]=="4") {echo 'selected="selected"'; }}?> value="4">4 Minutes</option>
                                                        <option <?php if(isset($assTask["practiceDuration"])){if($assTask["practiceDuration"]=="6") {echo 'selected="selected"'; }}?> value="6">6 Minutes</option>
                                                        <option <?php if(isset($assTask["practiceDuration"])){if($assTask["practiceDuration"]=="8") {echo 'selected="selected"'; }}?> value="8">8 Minutes</option>
                                                        <option <?php if(isset($assTask["practiceDuration"])){if($assTask["practiceDuration"]=="10") {echo 'selected="selected"'; }}?> value="10">10 Minutes</option>
                                                        <option <?php if(isset($assTask["practiceDuration"])){if($assTask["practiceDuration"]=="20") {echo 'selected="selected"'; }}?> value="20">20 Minutes</option>
                                                        <option <?php if(isset($assTask["practiceDuration"])){if($assTask["practiceDuration"]=="30") {echo 'selected="selected"'; }}?> value="30">30 Minutes</option>
                                                        <option <?php if(isset($assTask["practiceDuration"])){if($assTask["practiceDuration"]=="40") {echo 'selected="selected"'; }}?> value="40">40 Minutes</option>
                                                        <option <?php if(isset($assTask["practiceDuration"])){if($assTask["practiceDuration"]=="60") {echo 'selected="selected"'; }}?> value="60">1 Hour</option>
                                                        <option <?php if(isset($assTask["practiceDuration"])){if($assTask["practiceDuration"]=="90") {echo 'selected="selected"'; }}?> value="90">1 1/2 Hours</option>
                                                        <option <?php if(isset($assTask["practiceDuration"])){if($assTask["practiceDuration"]=="120") {echo 'selected="selected"'; }}?> value="120">2 Hours</option>
                                                    </select>   
                                                </div>
                                            </div>  
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Minimum Duration </label>
                                                    <select <?php if(isset($assTask["minDuration"])){ echo "disabled='disabled'"; }else{$assTask["minDuration"]="";} ?> class="form-control" id="minDuration" name="minDuration" required>
                                                        <option <?php if(isset($assTask["minDuration"])){if($assTask["minDuration"]=="1") {echo 'selected="selected"'; }}?> value="1">1 Minute</option>
                                                        <option <?php if(isset($assTask["minDuration"])){if($assTask["minDuration"]=="2") {echo 'selected="selected"'; }}?> value="2">2 Minute</option>
                                                    </select>
                                                </div>
                                            </div>
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
    <?php echo "var basepath='".$basepath_admin."';";     ?>

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

        function getTaskDuration(){
    
       // taskId = $('[name="taskId"]');
        var taskId = $('[name="taskId"]').val();
                
                $.ajax({
                  method: "POST",
                  url: basepath+"getTaskDuration",
                  data: {taskId:taskId},
                   beforeSend: function(){
                     // Handle the beforeSend event
                     // var $this = $("#commentButton");
                      //  $this.button('loading');
                      $("#msg-taskduration").show();
                   }

                }).done(function( data ) {
                    
                    var data  = eval('(' + data + ')');
                      $("#msg-taskduration").hide();
                     // console.log(data);
                      //alert(parseInt(data.practiceDuration));
                      $("#practiceDuration").val(parseInt(data.practiceDuration));
                      $("#minDuration").val(parseInt(data.minDuration));
                 });
        }
	</script>
</body>

</html>
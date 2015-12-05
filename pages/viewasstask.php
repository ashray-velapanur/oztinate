<?php include("includes/header.php") ?> 
   <!-- jQuery -->
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
		<?php echo "var basepath='".$basepath_admin."';"; 
			  echo "var assTaskId=".$taskData["Id"].";";	
			  echo "var userId=".$_SESSION["userId"].";";	
			  echo "var userName='".$_SESSION["username"]."';";	
		?>
			function addComment(){
				var comment = $("#commentTxt").val();
				if(comment==""){ alert("Please add comment text."); return false;}
				
				$.ajax({
				  method: "POST",
				  url: basepath+"addComment",
				  data: {assTaskId:assTaskId, comment: comment, userId: userId },
				  beforeSend: function(){
					 // Handle the beforeSend event
					  var $this = $("#commentButton");
						$this.button('loading');
				   }
				  
				}).done(function( data ) {
					  var $this = $("#commentButton");
						 $this.button('reset');
						
					var status  = eval('(' + data + ')');
					$("#comment_ul").prepend('<li class="left clearfix"><div class="chat-body clearfix"><div class="header"><strong class="primary-font">'+userName+'</strong><small class="pull-right text-muted"><i class="fa fa-clock-o fa-fw"></i>'+status.createddate+'</small></div><p>'+status.commentText+'</p></div></li>');
					 //var offset = $('#comment_ul li').first().position().top;
					 //alert(offset);
					$('#comment_ul').animate({
						 //scrollTop: $('#comment_ul li:nth-child(14)').position().top 
						 scrollTop: $('#comment_ul li').position().top
					}, 'slow');
					$("#commentTxt").val("");
				 });
			  }
			  
			function changeStatus(component)
			{
				var r = confirm("Are you sure you want to change status?");
				if (r == true) {
					$("#statusTxt").val($(component).context.innerText)
					$("#frmChangeStatus").submit();
				} else {
					txt = "You pressed Cancel!";
				}
				/*component = $(component);
				console.log(component);
				$("#statusBtn").html('Aborted');*/
			}			
	</script>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Assigned Task Details</h1>
						<div class="row">
							<div class="col-lg-4">
								<div class="stat-block">
                                    <h4 class="stat-heading text-muted">Exercise Name</h4>
                                    <h3 id="vehicle-yearmakemodel"><?php echo $taskData["taskName"] ?></h3>
                                </div>
							</div>
							<div class="col-lg-4">
								<div class="stat-block">
                                    <h4 class="stat-heading text-muted">Assigned To</h4>
                                    <h3 id="vehicle-yearmakemodel"><?php echo $taskData["userName"] ?></h3>
                                </div>
							</div>	
							<div class="col-lg-4">
								<div class="stat-block">
                                    <h4 class="stat-heading text-muted">Change Status</h4>
                                    <div class="btn-group">
									  <button type="button" id="statusBtn" class="btn btn-primary"><?php echo getTaskStatus($taskData["status"]); $statusList=getNextStatus($taskData["status"]);?></button>
									  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
									  </button>
									  <ul class="dropdown-menu" role="menu">
									  <?php foreach($statusList as $staus) {?>
										<li><a onClick="changeStatus(this);" href="#"><?php echo $staus ?></a></li>
										<?php } ?>						
									  </ul>
									</div>
                                </div>
								
								<?php if($statusChange==1){ ?>
									<label class="label label-success">Status Changed successfully</label>
								<?php } elseif($statusChange==2) { ?>
									<label class="label label-danger">Error... Status not changed. Please Load this page again and try</label>
								<?php }?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4">
								<div class="stat-block">
                                    <h4 class="stat-heading text-muted">Assigned Date</h4>
                                    <h3 id="vehicle-yearmakemodel"><?php echo $taskData["assignedDate"] ?></h3>
                                </div>
								
							</div>
							<div class="col-lg-4">
								<div class="stat-block">
                                    <h4 class="stat-heading text-muted">Completion Date</h4>
                                    <h3 id="vehicle-yearmakemodel"><?php echo $taskData["completionDate"] ?></h3>
                                </div>
								
							</div>
						</div>
						<div class="row">
						<?php if($taskData["status"]>0) {?>
							<div class="col-lg-6">
								<h2 class="page-header">Comments</h2>
								<div class="chat-panel panel panel-default">
									<div class="panel-heading">
										<i class="fa fa-comments fa-fw"></i>
										Comments
										
									</div>
									<!-- /.panel-heading -->
									<div class="panel-body">
										<ul class="chat" id="comment_ul">
											<?php while($row=mysql_fetch_array($comments)) { ?>
											<li class="left clearfix">
												<div class="chat-body clearfix">
													<div class="header">
														<strong class="primary-font"><?php echo $row["userName"] ?></strong>
														<small class="pull-right text-muted">
															<i class="fa fa-clock-o fa-fw"></i> <?php echo $row["createdDate"] ?>
														</small>
													</div>
													<p>
														<?php echo $row["commentText"] ?>
													</p>
												</div>
											</li>
											<?php } ?>
											
										</ul>
									</div>
									<!-- /.panel-body -->
									<div class="panel-footer">
										<div class="input-group">
											<input id="commentTxt" type="text" class="form-control input-sm" placeholder="Type your message here...">
											<span class="input-group-btn">
												<button type="button" class="btn btn-warning btn-sm" id="commentButton" id="btn-chat" onClick="addComment();" data-loading-text="Sending...<i class='fa fa-upload fa-fw'></i>">
													Send
												</button>
											</span>
										</div>
									</div>
									<!-- /.panel-footer -->
								</div>
							</div>
							<?php } ?>
							<div class="col-lg-6">
								<h2 class="page-header">Sound Clips</h2>
								<div class="panel panel-default">
									<div class="panel-heading">
										Sound Clips
									</div>
									<!-- /.panel-heading -->
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Upload Status</th>
														<th>Clip Url</th>
														<th>Download</th>
													</tr>
												</thead>
												<tbody>
												<?php while($row=mysql_fetch_array($soundClips)){?>
													<tr>
														<td><?php echo $row["clipId"] ?></td>
														<td><?php if($row["uploadStatus"]=="Y") echo "Uploaded"; else echo "Upload Pending"; ?></td>
														<td><a target="_blank" href="<?php echo $row["clipUrl"] ?>"><?php echo $row["clipUrl"] ?></a></td>
														<td><?php if($row["uploadStatus"]=="Y"){ ?><a  href="../../<?php echo "uploads/download.php?path=".$row["clipUrl"] ?>">Download</a><?php } else{ echo "File not uploaded";} ?></td>
													</tr>
												<?php }?>	
												</tbody>
											</table>
										</div>
										<!-- /.table-responsive -->
									</div>
									<!-- /.panel-body -->
								</div>
							</div>								
						</div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

  <form id="frmChangeStatus" action="" method="post"><input type="hidden" id="statusTxt" name="statusTxt"/></form>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
	
</body>

</html>

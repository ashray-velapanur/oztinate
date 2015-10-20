<?php include("includes/header.php") ?>
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
									<?php if($status=="Success") {?>
										<div class="alert alert-success">Exercise Assigned Successfully..!!!</div>
									<?php } else if($status=="Error") {?>	
										<div class="alert alert-danger">Error...!!! Exercise is not assigned</div>
									<?php } ?>	
                                    <form role="form" method="post">
                                        <div class="form-group">
                                            <label>Choose Exercise</label>
                                            <select class="form-control" name="taskId" required>
													<?php while($row=mysql_fetch_array($tasks)){?>
														<option value="<?php echo $row["taskId"] ?>"><?php echo $row["taskName"] ?></option>
													<?php } ?>
											</select>
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <div class="form-group">
                                            <label>Choose User</label>
                                             <select class="form-control" name="userId" required>
													<?php while($row=mysql_fetch_array($users)){?>
														<option value="<?php echo $row["userId"] ?>"><?php echo $row["userName"] ?></option>
													<?php } ?>
											</select>
                                        </div>
										<div class="form-group">
											<label>Completion Date</label>
											<input class="form-control" name="dateOfCompletion" type="date" required/>
										</div>
																						
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

</body>

</html>
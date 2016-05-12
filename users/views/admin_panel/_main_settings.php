<div class="row ">
	<div class="col-md-12">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					
					
				  <div class="panel panel-success">
					<div class="panel-heading">All Users <span class="small">(Who have logged in)</span></div>
					<div class="panel-body text-center">	
						<div class="row">
						  <div class="col-xs-3 "><h3><?=$hourCount?></h3><p>per hour</p></div>
						  <div class="col-xs-3"><h3><?=$dayCount?></h3><p>per day</p></div>
						  <div class="col-xs-3 "><h3><?=$weekCount?></h3><p>per week</p></div>
						  <div class="col-xs-3 "><h3><?=$monthCount?></h3><p>per month</p></div>
					  </div>
					</div>
				  </div><!--/panel-->
				  
				 <?php  if($settings->track_guest == 1){ ?>
				<div class="panel panel-warn">
					<div class="panel-heading">All Visitors <span class="small">(Whether logged in or not)</span></div>
					<div class="panel-body">	
						<?php
						  if (count_users() == 1) {
							  echo "   In the last 30 minutes, there was " . count_users() . " unique visitor online.<br>";
						  }
						  else {
							  echo "In the last 30 minutes, there were " . count_users() . " unique visitors online.<br>";
						  } ?>
					</div>
				  </div><!--/panel-->
					<?php } ?>				  

				 <?php  if($settings->track_guest != 1){ ?>
				<div class="panel panel-info">
					<div class="panel-heading">Guest Tracking Is Off <span class="small">(So we have this space)</span></div>
					<div class="panel-body">	
						For Something
					</div>
				  </div><!--/panel-->
					<?php } ?>	
					
					
			</div> <!-- /col -->
				
				<div class="col-xs-12 col-md-6">
				
				
				 <div class="panel panel-success">
					<div class="panel-heading">Logged In Users <span class="small">(past 24 hours)</span></div>
					<div class="panel-body">	
						 <div class="uvistable table-responsive">
							<table class="table">
							  <thead>
								<tr>
								  <th>Username</th>
								  <th>[IP]</th>
								 </tr>
							  </thead>
							  <tbody>
								<?php foreach($usersDay as $v1){ ?>
								 <tr>
									<td><a href="admin_user.php?id=<?=$v1->id?>"><?=ucfirst($v1->username)?></a></td>
									<td>[0.0.0.0]</td>
								</tr>
								<?php } ?>
							  </tbody>
							</table>
						  </div>					

					</div>
				  </div><!--/panel-->
				
				
			
				</div> <!-- /col2/2 -->
			</div> <!-- /row -->


	</div> <!-- /col1/1 -->
</div> <!-- /row -->




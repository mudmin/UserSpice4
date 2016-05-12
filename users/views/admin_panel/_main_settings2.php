<div class="row">
	<div class="col-xs-12 col-md-6">

		  <form class="" action="admin.php" name="settings" method="post">

		<h3 >UserSpice Settings</h3>

			<!-- List group -->

				<!-- Site Name -->
				
				  <label for="site_name">Site Name</label>
				  
					<input type="text" class="form-control" name="site_name" id="site_name" value="<?=$settings->site_name?>">
				  
				
				<!-- Recaptcha Option -->
				
				  <label for="recaptcha">Recaptcha</label>
				  <select id="recaptcha" class="form-control" name="recaptcha">
					<option value="1" <?php if($settings->recaptcha==1) echo 'selected="selected"'; ?> >Enabled</option>
					<option value="0" <?php if($settings->recaptcha==0) echo 'selected="selected"'; ?> >Disabled</option>
					</select>
				  

				  <!-- Login Via Username or Email -->
				  <!-- 
					<label for="login_type">Login Using (disabled)</label>
					<select id="login_type" class="form-control" name="login_type">
					  <option value="email" <?php if($settings->login_type=='email') echo 'selected="selected"'; ?> >Email</option>
					  <option value="username" <?php if($settings->login_type=='username') echo 'selected="selected"'; ?> >Username</option>
					  <label for="login_type" class="form-control"></label></select>
					 -->
					<!-- Force SSL -->
					
					  <label for="force_ssl">Force SSL (experimental)</label>
					  <select id="force_ssl" class="form-control" name="force_ssl">
						<option value="1" <?php if($settings->force_ssl==1) echo 'selected="selected"'; ?> >Yes</option>
						<option value="0" <?php if($settings->force_ssl==0) echo 'selected="selected"'; ?> >No</option>
						</select>
					  

					  <!-- Force Password Reset -->
					  <!-- 
						<label for="force_pr">Force Password Reset (disabled)</label>
						<select id="force_pr" class="form-control" name="force_pr">
						  <option value="1" <?php if($settings->force_pr==1) echo 'selected="selected"'; ?> >Yes</option>
						  <option value="0" <?php if($settings->force_pr==0) echo 'selected="selected"'; ?> >No</option>
						  <label for="force_pr" class="form-control"></label></select>
						 -->

						<!-- Site Offline -->
						
						  <label for="site_offline">Site Offline</label>
						  <select id="site_offline" class="form-control" name="site_offline">
							<option value="1" <?php if($settings->site_offline==1) echo 'selected="selected"'; ?> >Yes</option>
							<option value="0" <?php if($settings->site_offline==0) echo 'selected="selected"'; ?> >No</option>
							</select>
						  <!-- Track Guests -->
						  
							<label for="track_guest">Track Guests</label>
							<select id="track_guest" class="form-control" name="track_guest">
							  <option value="1" <?php if($settings->track_guest==1) echo 'selected="selected"'; ?> >Yes</option>
							  <option value="0" <?php if($settings->track_guest==0) echo 'selected="selected"'; ?> >No</option>
							</select>If your site gets a lot of traffic and starts to stumble, this is the first thing to turn off.
							
									  <input type="hidden" name="csrf" value="<?=Token::generate();?>" />
							

	
	</div> <!-- /col1/1 -->
	

	<div class="col-md-12"> <!-- Places Button on it's own full-width row, covering both columns -->
		<input class='btn btn-primary' type='submit' name="settings" value='Update Settings' />
	</div>
	
	</form>
</div> <!-- /row -->

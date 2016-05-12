<div class="row">
	<div class="col-md-12">

		  <form class="" action="admin.php" name="settings" method="post">

		<h3 >UserSpice Settings</h3>

			<!-- List group -->
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th>Option</th>
				  <th>Setting</th>
				</tr>
			  </thead>
			  <tbody>

				<!-- Site Name -->
				<tr>
				  <td><label for="site_name">Site Name</label></td>
				  <td>
					<input type="text" class="form-control" name="site_name" id="site_name" value="<?=$settings->site_name?>">
				  </td>
				</tr>
				<!-- Recaptcha Option -->
				<tr>
				  <td><label for="recaptcha">Recaptcha</label></td>
				  <td><select id="recaptcha" class="form-control" name="recaptcha">
					<option value="1" <?php if($settings->recaptcha==1) echo 'selected="selected"'; ?> >Enabled</option>
					<option value="0" <?php if($settings->recaptcha==0) echo 'selected="selected"'; ?> >Disabled</option>
					</select></td>
				  </tr>

				  <!-- Login Via Username or Email -->
				  <!-- <tr>
					<td><label for="login_type">Login Using (disabled)</label></td>
					<td><select id="login_type" class="form-control" name="login_type">
					  <option value="email" <?php if($settings->login_type=='email') echo 'selected="selected"'; ?> >Email</option>
					  <option value="username" <?php if($settings->login_type=='username') echo 'selected="selected"'; ?> >Username</option>
					  <label for="login_type" class="form-control"></label></select></td>
					</tr> -->

					<!-- Force SSL -->
					<tr>
					  <td><label for="force_ssl">Force SSL (experimental)</label></td>
					  <td><select id="force_ssl" class="form-control" name="force_ssl">
						<option value="1" <?php if($settings->force_ssl==1) echo 'selected="selected"'; ?> >Yes</option>
						<option value="0" <?php if($settings->force_ssl==0) echo 'selected="selected"'; ?> >No</option>
						</select></td>
					  </tr>

					  <!-- Force Password Reset -->
					  <!-- <tr>
						<td><label for="force_pr">Force Password Reset (disabled)</label></td>
						<td><select id="force_pr" class="form-control" name="force_pr">
						  <option value="1" <?php if($settings->force_pr==1) echo 'selected="selected"'; ?> >Yes</option>
						  <option value="0" <?php if($settings->force_pr==0) echo 'selected="selected"'; ?> >No</option>
						  <label for="force_pr" class="form-control"></label></select></td>
						</tr> -->

						<!-- Site Offline -->
						<tr>
						  <td><label for="site_offline">Site Offline</label></td>
						  <td><select id="site_offline" class="form-control" name="site_offline">
							<option value="1" <?php if($settings->site_offline==1) echo 'selected="selected"'; ?> >Yes</option>
							<option value="0" <?php if($settings->site_offline==0) echo 'selected="selected"'; ?> >No</option>
							</select></td>
						  </tr>
						  <!-- Track Guests -->
						  <tr>
							<td><label for="track_guest">Track Guests</label></td>
							<td><select id="track_guest" class="form-control" name="track_guest">
							  <option value="1" <?php if($settings->track_guest==1) echo 'selected="selected"'; ?> >Yes</option>
							  <option value="0" <?php if($settings->track_guest==0) echo 'selected="selected"'; ?> >No</option>
							</select>If your site gets a lot of traffic and starts to stumble, this is the first thing to turn off.
							
									  <input type="hidden" name="csrf" value="<?=Token::generate();?>" />
							
							</td>

							</tr>
				




					
					  </tbody>
					</table>
							<input class='btn btn-primary' type='submit' name="settings" value='Update Settings' />
	</form>
	</div> <!-- /col1/1 -->
</div> <!-- /row -->

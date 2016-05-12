	<div class="form-signup">

	<form action="<?=$form_action;?>" method="<?=$form_method;?>" id="payment-form">
  <input type="hidden" value="<?=Token::generate();?>" name="csrf">
  <span id="payment-errors" class="bg-danger payment-errors"></span>
	
			<h2 class="form-signin-heading"><i class="fa fa-flask"></i> <?=lang("SIGNUP_TEXT","");?></h2>

			<div class="form-group">
				<label for="username">Choose a Username</label>
				<input  class="form-control" type="text" name="username" id="username" placeholder="Username" value="<?php if (!$form_valid && !empty($_POST)){ echo $username;} ?>" required autofocus>
							
				<p class="help-block">No Spaces or Special Characters - Min 5 characters</p>
			</div>

			  <div class="form-group">
				<label for="fname">First Name:</label>
				<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php if (!$form_valid && !empty($_POST)){ echo $fname;} ?>" required>
				
			  </div>
			  
			  <div class="form-group">
				<label for="lname">Last Name:</label>
				<input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php if (!$form_valid && !empty($_POST)){ echo $lname;} ?>" required>
					
			  </div>

		
			<div class="form-group">
				<label for="email">Email Address</label>
				<input  class="form-control" type="text" name="email" id="email" placeholder="Email Address" value="<?php if (!$form_valid && !empty($_POST)){ echo $email;} ?>" required >
					
			</div>

			<!-- Company is here if you want it -->
			  <div class="form-group">
				<label for="company">Company Name:</label>
				<input type="text" class="form-control" id="company" name="company" placeholder="Company Name" value="<?php if (!$form_valid && !empty($_POST)){ echo $company;} ?>">
					
			  </div>
			
			<div class="form-group">
				<label for="password">Choose a Password</label>
				<input  class="form-control" type="password" name="password" id="password" placeholder="Password" required aria-describedby="passwordhelp">
				<span class="help-block" id="passwordhelp">Must be at least 6 characters</span>
			</div>

			<div class="form-group">
				<label for="confirm">Confirm Password</label>
				<input  type="password" id="confirm" name="confirm" class="form-control" placeholder="Confirm Password" required >
			</div>
			
			<?php if($settings->recaptcha == 1){ ?>
			<div class="form-group">
				<div class="g-recaptcha" data-sitekey="<?=$publickey; ?>"></div>
			</div>
			<?php } ?>
		
			<button class="submit btn btn-lg btn-primary btn-block" type="submit" id="next_button"><i class="fa fa-plus-square"></i> <?=lang("SIGNUP_BUTTONTEXT","");?></button>
			

		</form>


	  </div>
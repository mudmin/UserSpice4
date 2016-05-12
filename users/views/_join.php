<?php
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<div class="row">
<div class="col-xs-12">
<?php 
if (!$form_valid && Input::exists()){
	echo display_errors($validation->errors());
}
?>

<form class="form-signup" action="<?=$form_action;?>" method="<?=$form_method;?>" id="payment-form">
	
	<h2 class="form-signin-heading"> <?=lang("SIGNUP_TEXT","");?></h2>

	<div class="form-group">
		<label for="username">Choose a Username</label>
		<input  class="form-control" type="text" name="username" id="username" placeholder="Username" value="<?php if (!$form_valid && !empty($_POST)){ echo $username;} ?>" required autofocus>
		<p class="help-block">No Spaces or Special Characters - Min 5 characters</p>
	</div>
	<div class="form-group">
		<label for="fname">First Name</label>
		<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php if (!$form_valid && !empty($_POST)){ echo $fname;} ?>" required>
	</div>
	<div class="form-group">
		<label for="lname">Last Name</label>
		<input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php if (!$form_valid && !empty($_POST)){ echo $lname;} ?>" required>
	</div>
	<div class="form-group">
		<label for="email">Email Address</label>
		<input  class="form-control" type="text" name="email" id="email" placeholder="Email Address" value="<?php if (!$form_valid && !empty($_POST)){ echo $email;} ?>" required >
	</div>
	<div class="form-group">
		<label for="company">Company Name</label>
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
	<div class="form-group">
		<label for="confirm">Registration User Terms and Conditions</label>
		<textarea id="agreement" name="agreement" rows="5" class="form-control" disabled ><?php require '../usersc/includes/user_agreement.php'; ?></textarea>
	</div>
	<div class="form-group">
		<label for="confirm">Check box to agree to terms</label>
		<input type="checkbox" id="agreement_checkbox" name="agreement_checkbox" class="form-control">
	</div>

	<?php if($settings->recaptcha == 1){ ?>
	<div class="form-group">
		<div class="g-recaptcha" data-sitekey="<?=$publickey; ?>"></div>
	</div>
	<?php } ?>
	<input type="hidden" value="<?=Token::generate();?>" name="csrf">
	<button class="submit btn btn-primary " type="submit" id="next_button"><i class="fa fa-plus-square"></i> <?=lang("SIGNUP_BUTTONTEXT","");?></button>
</form>
</div>
</div>
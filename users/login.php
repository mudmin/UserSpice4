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
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
ini_set("allow_url_fopen", 1);
?>
<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>
<?php
$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();
$error_message = '';
$reCaptchaValid=FALSE;

if (Input::exists()) {
	$token = Input::get('csrf');
	if(!Token::check($token)){
		die('Token doesn\'t match!');
	}
	
	//Check to see if recaptcha is enabled
	if($settings->recaptcha == 1){
		require_once 'includes/recaptcha.config.php';

		//reCAPTCHA 2.0 check
		$response = null;

		// check secret key
		$reCaptcha = new ReCaptcha($privatekey);
		
		// if submitted check response
		if ($_POST["g-recaptcha-response"]) {
			$response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);
		}
		if ($response != null && $response->success) {
			$reCaptchaValid=TRUE;
		
		}else{
			$reCaptchaValid=FALSE;
			$error_message .= 'Please check the reCaptcha.';
		}
	}else{
		$reCaptchaValid=TRUE;
	}
	
	if($reCaptchaValid || $settings->recaptcha == 0){ //if recaptcha valid or recaptcha disabled

		$validate = new Validate();
		$validation = $validate->check($_POST, array('username' => array('display' => 'Username','required' => true),'password' => array('display' => 'Password', 'required' => true)));

		if ($validation->passed()) {
			//Log user in

			$remember = (Input::get('remember') === 'on') ? true : false;
			$user = new User();
			$login = $user->login(Input::get('username'), trim(Input::get('password')), $remember);
			if ($login) {
				if(file_exists($abs_us_root.$us_url_root.'usersc/scripts/custom_login_script.php')){
					require_once $abs_us_root.$us_url_root.'usersc/scripts/custom_login_script.php';
				}else{
					//Feel free to change where the user goes after login!
					Redirect::to('account.php');
				}
			} else {
				$error_message .= 'Log in failed. Please check your username and password and try again.';
			}
		} else{
			$error_message .= '<ul>';
			foreach ($validation->errors() as $error) {
				$error_message .= '<li>' . $error . '</li>';
			}
			$error_message .= '</ul>';
		}
	}
}

?>

<div id="page-wrapper">
<div class="container">
<div class="row">
	<div class="col-xs-12">
	<div class="bg-danger"><?=$error_message;?></div>
	<form name="login" class="form-signin" action="login.php" method="post">
	<h2 class="form-signin-heading"></i> <?=lang("SIGNIN_TITLE","");?></h2>
	
	<div class="form-group">
		<label for="username" >Username</label>
		<input  class="form-control" type="text" name="username" id="username" placeholder="Username" required autofocus>
	</div>

	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control"  name="password" id="password"  placeholder="Password" required autocomplete="off">
	</div>

	<?php
	if($settings->recaptcha == 1){
	?>
	<div class="form-group">
	<label>Please check the box below to continue</label>
	<div class="g-recaptcha" data-sitekey="<?=$publickey; ?>"></div>
	</div>
	<?php } ?>

	<div class="form-group">
	<label for="remember">
	<input type="checkbox" name="remember" id="remember" > Remember Me</label>
	</div>

	<input type="hidden" name="csrf" value="<?=Token::generate(); ?>">
	<button class="submit  btn  btn-primary" type="submit"><i class="fa fa-sign-in"></i> <?=lang("SIGNIN_BUTTONTEXT","");?></button>

	</form>
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<a class="pull-left" href='forgot_password.php'><i class="fa fa-wrench"></i> Forgot Password</a>
	</div>
	<div class="col-xs-6">
		<a class="pull-right" href='join.php'><i class="fa fa-plus-square"></i> <?=lang("SIGNUP_TEXT","");?></a>
	</div>
</div>
</div>
</div>

    <!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

<?php 	if($settings->recaptcha == 1){ ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php } ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

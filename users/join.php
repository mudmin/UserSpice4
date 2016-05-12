<?php
/*
UserSpice 4
An Open Source PHP User Management System
by Curtis Parham and Dan Hoover at http://UserSpice.com

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
<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();
if($settings->recaptcha == 1){
	require_once("includes/recaptcha.config.php");
}
//There is a lot of commented out code for a future release of sign ups with payments
$form_method = 'POST';
$form_action = 'join.php';
$vericode = rand(100000,999999);

$form_valid=FALSE;

//Decide whether or not to use email activation
$query = $db->query("SELECT * FROM email");
$results = $query->first();
$act = $results->email_act;

//Opposite Day for Pre-Activation - Basically if you say in email
//settings that you do NOT want email activation, this lists new
//users as active in the database, otherwise they will become
//active after verifying their email.
if($act==1){
	$pre = 0;
} else {
	$pre = 1;
}
?>

<?php
if(!empty($_POST)){
	
	$csrf = Input::get('csrf');
	$username = Input::get('username');
	$fname = Input::get('fname');
	$lname = Input::get('lname');
	$email = Input::get('email');
	$company = Input::get('company');
	
	if (Token::check($csrf)){
		$db = DB::getInstance();
		$settingsQ = $db->query("SELECT * FROM settings");
		$settings = $settingsQ->first();
		$validation = new Validate();
		$validation->check($_POST,array(
		  'username' => array(
			'display' => 'Username',
			'required' => true,
			'min' => 5,
			'max' => 35,
		  ),
		  'fname' => array(
			'display' => 'First Name',
				'required' => true,
				'min' => 2,
				'max' => 35,
		  ),
		  'lname' => array(
			'display' => 'Last Name',
			'required' => true,
			'min' => 2,
			'max' => 35,
		  ),
		  'email' => array(
			'display' => 'Email',
			'required' => true,
			'valid_email' => true,
			'unique' => 'users',
		  ),
		  'company' => array(
			'display' => 'Company Name',
			'required' => false,
			'min' => 0,
			'max' => 75,
		  ),
		  'password' => array(
			'display' => 'Password',
			'required' => true,
			'min' => 6,
			'max' => 25,
		  ),
		  'confirm' => array(
			'display' => 'Confirm Password',
			'required' => true,
			'matches' => 'password',
		  ),
		));

		if($validation->passed()){
			//bold('SUCCESS');
			$form_valid=TRUE;
			
			//Logic if ReCAPTCHA is turned ON
			if($settings->recaptcha == 1){
				require_once("includes/recaptcha.config.php");
				//reCAPTCHA 2.0 check
				$response = null;

				// check secret key
				$reCaptcha = new ReCaptcha($privatekey);

				// if submitted check response
				if ($_POST["g-recaptcha-response"]) {
					$response = $reCaptcha->verifyResponse(
						$_SERVER["REMOTE_ADDR"],
						$_POST["g-recaptcha-response"]);
				}
				if ($response != null && $response->success) {
					//add user to the database
					$user = new User();
					$join_date = date("Y-m-d H:i:s");
					$params = array(
						'fname' => Input::get('fname'),
						'email' => $email,
						'vericode' => $vericode,
					);

					if($act == 1) {
						//Verify email address settings
						$to = $email;
						$subject = 'Welcome to UserSpice!';
						$body = email_body('verify.php',$params);
						email($to,$subject,$body);
					}
					try {
						// echo "Trying to create user";
						$user->create(array(
							'username' => Input::get('username'),
							'fname' => Input::get('fname'),
							'lname' => Input::get('lname'),
							'email' => Input::get('email'),
							'password' =>
							password_hash(Input::get('password'), PASSWORD_BCRYPT, array('cost' => 12)),
							'permissions' => 1,
							'account_owner' => 1,
							'stripe_cust_id' => '',
							'join_date' => $join_date,
							'company' => Input::get('company'),
							'email_verified' => $pre,
							'active' => 1,
							'vericode' => $vericode,
						));
					} catch (Exception $e) {
						die($e->getMessage());
					}
				}
				
			}else{
				//Logic if ReCAPTCHA is turned OFF
				//add user to the database
				$user = new User();
				$join_date = date("Y-m-d H:i:s");
				$params = array(
					'fname' => Input::get('fname'),
					'email' => $email,
					'vericode' => $vericode,
				);

				if($act == 1) {
					//Verify email address settings
					$to = $email;
					$subject = 'Welcome to UserSpice!';
					$body = email_body('verify.php',$params);
					email($to,$subject,$body);
				}
				try {
					// echo "Trying to create user";
					$user->create(array(
						'username' => Input::get('username'),
						'fname' => Input::get('fname'),
						'lname' => Input::get('lname'),
						'email' => Input::get('email'),
						'password' =>
						password_hash(Input::get('password'), PASSWORD_BCRYPT, array('cost' => 12)),
						'permissions' => 1,
						'account_owner' => 1,
						'stripe_cust_id' => '',
						'join_date' => $join_date,
						'company' => Input::get('company'),
						'email_verified' => $pre,
						'active' => 1,
						'vericode' => $vericode,
					));
				} catch (Exception $e) {
					die($e->getMessage());
				}
			} //else for recaptcha
			Redirect::to($us_url_root.'users/joinThankYou.php');
			
		}else{
			$form_valid=FALSE;
		}
		//
		//bold('CSRF PASSED');
	}else{
		//bold('CSRF FAILED');
		die('Token doesn\'t match!');
		
	}
	//bold('POST SET');
} //if $_POST not empty

?>

<?php
//this is the standard, no cost register form
//If some of this code looks funny it's because it is prepared for
//an additional join form with stripe payment options.
?>
<div id="page-wrapper">
	<div class="container">
	<!-- Page Heading -->
		<div class="row">
			<div class="col-md-12">
				<?php 
				if (!$form_valid && !empty($_POST)){
					echo display_errors($validation->errors());					
				}
				?>
				<?php require 'views/join/_join_form.php'; ?>
			</div>
		</div>
	</div>
</div>

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->
<script>

</script>

<?php 	if($settings->recaptcha == 1){ ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php } ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

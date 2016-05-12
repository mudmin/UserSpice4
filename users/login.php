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
<?php
$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();
$error_message = '';
if (Input::exists()) {
	//Check to see if recaptcha is enabled
	if($settings->recaptcha == 1){
		require_once("includes/recaptcha.config.php");
		//reCAPTCHA 2.0 check

		$response = null;
		// check secret key

		$reCaptcha = new ReCaptcha($privatekey);
		// if submitted check response

		if ($_POST["g-recaptcha-response"]) {
			$response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);
		}
		if ($response != null && $response->success) {
			if (Token::check(Input::get('token'))) {
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
		}else{
			$error_message .= 'Please check the reCaptcha.';
		}
	}else{
		if (Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array('username' => array('display' => 'Username', 'required' => true),'password' => array('display' => 'Password', 'required' => true)));

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
				}else {
					$error_message .= 'Log in failed. Please check your username and password and try again.';
				}
			}else{
				$error_message .= '<ul>';
				foreach ($validation->errors() as $error) {
					$error_message .= '<li>' . $error . '</li>';
				}
				$error_message .= '</ul>';
			}
		}
	} //if recaptcha else
} //if input exists

?>

<div id="page-wrapper">

  <div class="container">

         <?php include 'views/login/_login_form.php'; ?>


      </div>
    </div>

    <!-- /.row -->


    <!-- Content Ends Here -->
    <!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

<?php 	if($settings->recaptcha == 1){ ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php } ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

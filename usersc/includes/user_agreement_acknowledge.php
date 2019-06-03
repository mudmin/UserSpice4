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
<?php
require_once '../../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>

<?php if(!isset($user) || !$user->isLoggedIn()){Redirect::to($us_url_root.'users/login.php');} ?>
<?php
if(!empty($_POST)){
	$token = Input::get('csrf');
	if(!Token::check($token)){
		include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
	}
	$db->update('users',$user->data()->id,['oauth_tos_accepted'=>1]);
	if(!is_null($settings->redirect_uri_after_login) && $settings->redirect_uri_after_login!='') {
		Redirect::to($settings->redirect_uri_after_login);
	} elseif (file_exists($abs_us_root.$us_url_root.'usersc/scripts/custom_login_script.php')) {
		require_once $abs_us_root.$us_url_root.'usersc/scripts/custom_login_script.php';
	} else {
		Redirect::to('../../users/account.php');
	}
}
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
					<h1>Our Terms Have Changed</h1>
					<form class="" action="" method="post">
						<label for="confirm">Registration User Terms and Conditions</label>
						<textarea id="agreement" name="agreement" rows="20" class="form-control" disabled ><?php require $abs_us_root.$us_url_root.'usersc/includes/user_agreement.php'; ?></textarea><br>
						<input type="hidden" value="<?=Token::generate();?>" name="csrf">
						<button class="submit btn btn-primary " type="submit" id="next_button"><i class="fa fa-plus-square"></i> Accept Terms and Continue</button>
					</form>

			</div> <!-- /.col -->
		</div> <!-- /.row --><br>
	</div> <!-- /.container -->
</div> <!-- /.wrapper -->


	<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

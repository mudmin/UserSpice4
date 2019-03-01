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
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
$action=Input::get('action');
$errors = [];
$successes = [];

if(Input::exists()){
  $token = $_POST['csrf'];
  if(!Token::check($token)){
    include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
  }

	$agreement_checkbox=Input::get('agreement_checkbox');
	if(!$agreement_checkbox){
		$errors[] = "Please read and accept terms and conditions";
	} else {
		$db->update('users',$user->data()->id,['oauth_tos_accepted' => true]);
		if(!$db->error()) {
			logger($user->data()->id,"OAuth Success-TOS","User Accepted TOS");
			Redirect::to('oauth_success.php');
		} else {
			$error=$db->errorString();
			logger($user->data()->id,"OAuth Success-TOS","Failed to update user oauth_tos to True: ".$error);
			$errors[] = "FATAL ERROR, please contact System Admin";
		}
	}
}

?>
<div id="page-wrapper">
	<?=resultBlock($errors,$successes);?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<?php if($action=='') {?>
				<h3 align="center">You have successfully logged in...redirecting now.</h3>
				<?php require_once $abs_us_root.$us_url_root.'usersc/includes/oauth_success_redirect.php';?>
				<?=Redirect::to($us_url_root.'users/account.php'); ?>
			<?php }
      if($settings->show_tos == 1){
      if($action=='tos') {
				if($user->data()->oauth_tos_accepted) Redirect::to('oauth_success.php');
				?>
				<h2>Registration Terms of Service</h2>
				<form class="form-signup" action="?action=tos" method="POST">
					<textarea id="agreement" name="agreement" rows="5" class="form-control" disabled ><?php require $abs_us_root.$us_url_root.'usersc/includes/user_agreement.php'; ?></textarea>
					<br>
					<label><input type="checkbox" id="agreement_checkbox" name="agreement_checkbox"> Check box to agree to terms</label>

					<input type="hidden" value="<?=Token::generate();?>" name="csrf">
	        <button class="submit btn btn-primary " type="submit" id="oauth_tos_accept"><i class="fa fa-plus-square"></i> Submit</button>
				</form>
				<br>
			<?php
        }
      }else{
        Redirect::to('oauth_success.php'); //because TOS are disabled
      }
    ?>
			</div>
		</div>
	</div>
</div>
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>

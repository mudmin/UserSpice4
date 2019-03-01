<?php
// This is a user-facing page
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

if (!securePage($_SERVER['PHP_SELF'])){die();}
if($settings->twofa != 1){
  Redirect::to($us_url_root.'users/account.php?err=Sorry.Two+factor+is+not+enabled+at+this+time');
}
if($user->data()->twoKey=='' || is_null($user->data()->twoKey) || $user->data()->twoEnabled==0) Redirect::to($us_url_root.'users/account.php?err=Two FA is not enabled.');

if (!empty($_POST)) {
  $token = $_POST['csrf'];
  if(!Token::check($token)){
    include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
  }

  if(!empty($_POST['twoChange']) && $settings->twofa == 1) {
        $twofa=Input::get('twofa');
        if($twofa==1) {
          $db->query("UPDATE users SET twoKey=null,twoEnabled=0 WHERE id = ?",[$user->data()->id]);
          logger($user->data()->id,"Two FA","Disabled Two FA");
          Redirect::to($us_url_root.'users/account.php?msg=Two FA has been disabled.');
        }
      }
    }
?>

<div id="page-wrapper">
  <div class="container">
    <div class="well">
      <div class="row">
      	<div class="col-sm-12 col-md-3">
              <p><a href="../users/account.php" class="btn btn-primary">Account Home</a></p>
              <p><a href="../users/manage2fa.php" class="btn btn-primary">Manage 2FA</a></p>

          </div>
          <div class="col-sm-12 col-md-9">
              <h1>Disable 2-Factor</h1>
              <p>Are you sure you want to disable 2FA? Your account will no longer be protected.</p>
              <form class="verify-admin" action="disable2fa.php" method="POST">
              <div class="col-md-5">
              <div class="input-group">
                <select name="twofa" id="twofa" class="form-control">
                  <option value="0">No, keep it on!</option>
                  <option value="1">Yes, turn it off...</option>
                </select>
                  <span class="input-group-btn">
                  <input class='btn btn-primary' type='submit' name='twoChange' value='Submit' />
                </span></div>
              <input type="hidden" value="<?=Token::generate();?>" name="csrf">
              </div>
               </div>
             </form><br />
          </div>
        </div>
      </div>
    </div>
  </div>

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>

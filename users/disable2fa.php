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
  $msg = lang("REDIR_2FA");
  Redirect::to($us_url_root.'users/account.php?err='.$msg);
}
if($user->data()->twoKey=='' || is_null($user->data()->twoKey) || $user->data()->twoEnabled==0){
  $msg = lang("REDIR_2FA");
  Redirect::to($us_url_root.'users/account.php?err='.$msg);
}

if (!empty($_POST)) {
  $token = $_POST['csrf'];
  if(!Token::check($token)){
    include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
  }

  if(!empty($_POST['twoChangeHook']) && $settings->twofa == 1) {
        $twofa=Input::get('twofa');
        if($twofa==1) {
          $db->query("UPDATE users SET twoKey=null,twoEnabled=0 WHERE id = ?",[$user->data()->id]);
          logger($user->data()->id,"Two FA","Disabled Two FA");
          $msg = lang("REDIR_2FA_DIS");
          Redirect::to($us_url_root.'users/account.php?msg='.$msg);
        }
      }
    }
?>
      <div class="row">
      	<div class="col-sm-12 col-md-3">
              <p><a href="../users/account.php" class="btn btn-primary"><?=lang("ACCT_HOME")?>/a></p>
              <p><a href="../users/manage2fa.php" class="btn btn-primary"><?=lang("ACCT_2FA");?></a></p>

          </div>
          <div class="col-sm-12 col-md-9">
              <h1><?=lang("GEN_DISABLE")?> <?=lang("2FA");?></h1>
              <p><?=lang("2FA_CONFIRM");?></p>
              <form class="verify-admin" action="disable2fa.php" method="POST">
              <div class="col-md-5">
              <div class="input-group">
                <select name="twofa" id="twofa" class="form-control">
                  <option value="0"><?=lang("GEN_NO")?></option>
                  <option value="1"><?=lang("GEN_YES")?></option>
                </select>
                  <span class="input-group-btn">
                  <input type="hidden" name="twoChangeHook" value="1">
                  <input class='btn btn-primary' type='submit' name='twoChange' value='<?=lang("GEN_SUBMIT")?>' />
                </span></div>
              <input type="hidden" value="<?=Token::generate();?>" name="csrf">
              </div>
               </div>
             </form><br />
          </div>

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>

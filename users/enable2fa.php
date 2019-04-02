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

use PragmaRX\Google2FA\Google2FA;
$google2fa = new Google2FA();

if(IS_NULL($user->data()->twoKey)) $db->update('users',$user->data()->id,['twoKey'=>$google2fa->generateSecretKey()]);
$twoUser = $db->query("SELECT email,twoKey FROM users WHERE id = ?",[$user->data()->id])->first();
$google2fa->setAllowInsecureCallToGoogleApis(true);
$google2fa_url = $google2fa->getQRCodeGoogleUrl(
    $settings->site_name,
    $twoUser->email,
    $twoUser->twoKey
);

$msg1 = lang("REDIR_2FA_VER");
$msg2 = lang("2FA_FAIL");
?>

<div id="page-wrapper">
  <div class="container">
    <div class="well">
      <div class="row">
      	<div class="col-sm-12 col-md-3">
              <p><a href="account.php" class="btn btn-primary"><?=lang("ACCT_HOME")?></a></p>

          </div>
          <div class="col-sm-12 col-md-9">
              <h1><?=lang("GEN_MANAGE")?> <?=lang("2FA");?></h1>
              <p><?=lang("2FA_SCAN")?>: <b><?php echo $twoUser->twoKey; ?></b></p>
              <p><img src="<?php echo $google2fa_url; ?>"></p>
              <p><?=lang("2FA_THEN")?>:</p>
              <p>
                  <table border="0">
                      <tr>
                          <td><input class="form-control" placeholder="2FA Code" type="text" name="twoCode" id="twoCode" size="10" required autofocus></td>
                          <td><button id="twoBtn" class="btn btn-primary"><?=lang("GEN_VERIFY");?></button></td>
                      </tr>
                  </table>
              </p>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->
<script>
    $(document).ready(function() {
        var input = document.getElementById("twoCode");
        input.addEventListener("keyup", function(event) {
          event.preventDefault();
          if (event.keyCode === 13) {
            document.getElementById("twoBtn").click();
          }
        });
        $("#twoBtn").click(function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?=$us_url_root?>users/api/",
                data: {
                    action: "verify2FA",
                    twoCode: $("#twoCode").val()
                },
                success: function(result) {
                    var resultO = JSON.parse(result);
                    if(!resultO.error){
                        var msg = '<?=$msg1?>';
                        window.location.replace("account.php?msg="+msg);
                    }else{
                        alert(resultO.errorMsg);
                    }
                },
                error: function(result) {
                    var msg2 = '<?=$msg2?>';
                    alert(msg2);
                }
            });
        });
    });
</script>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

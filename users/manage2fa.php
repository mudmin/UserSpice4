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
$errors=[];
$successes=[];
if (!empty($_POST)) {
  $token = $_POST['csrf'];
  if(!Token::check($token)){
    include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
  }

  if(!empty($_POST['twoChange']) && $settings->twofa == 1) {

    if(isset($_POST['deleteFingerprint'])) {
      $fingerprints = Input::get('deleteFingerprint');
      $expire = expireFingerprints($fingerprints);
      if($expire) {
        if($expire==1) $successes[] = "Expired 1 fingerprint";
        else $successes[] = "Expired $expire fingerprints";
      }
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
          <p><a href="../users/disable2fa.php" class="btn btn-primary">Disable 2FA</a></p>

        </div>
        <div class="col-sm-12 col-md-9">
          <h1>Manage 2-Factor</h1>
          <hr>
          <?=resultBlock($errors,$successes);?>
          <form class="verify-admin" action="manage2fa.php" method="POST">
            <h4>Recognized Fingerprints</h4>
            <table class="table table-bordered">
              <?php $fingerprints = fetchUserFingerprints();
              if($fingerprints) { ?>
                <tr>
                  <th width="60%">Information</th>
                  <th width="15%">Recorded</th>
                  <th width="15%">Expires</th>
                  <th width="10%">Delete</th>
                </tr>
                <?php foreach($fingerprints as $fingerprint) { ?>
                  <tr>
                    <td>
                      <?php if($fingerprint->AssetsAvailable) {?>
                        <?=$fingerprint->User_Browser?> on <?=$fingerprint->User_OS?> <?php if($fingerprint->Fingerprint==$_SESSION['fingerprint']) {?><sup>Current Session</sup><?php } ?><br>
                        <?php if($fingerprint->IP_Address!='::1') {
                           $geo = json_decode(file_get_contents("http://extreme-ip-lookup.com/json/$fingerprint->IP_Address"));
                           $country = $geo->country;
                           $city = $geo->city;
                           $ipType = $geo->ipType;
                           $businessName = $geo->businessName;
                           $businessWebsite = $geo->businessWebsite;

                           echo "Location of $fingerprint->IP_Address: $city, $country\n";
                        } } else { ?>
                        Assets Not Available
                      <?php } ?>
                    </td>
                    <td><span class="show-tooltip" title="<?=date("D, M j, Y g:i:sa",strtotime($fingerprint->Fingerprint_Added))?>"><?=time2str($fingerprint->Fingerprint_Added)?></span></td>
                    <td><span class="show-tooltip" title="<?=date("D, M j, Y g:i:sa",strtotime($fingerprint->Fingerprint_Expiry))?>"><?=time2str($fingerprint->Fingerprint_Expiry)?></span></td>
                    <td>
                      <?php if($fingerprint->Fingerprint!=$_SESSION['fingerprint']) {?>
                        <span class="button-checkbox">
                          <button type="button" class="btn" data-color="warning">Delete</button>
                          <input type="checkbox" class="hidden" name="deleteFingerprint[]" value="<?=$fingerprint->kFingerprintID?>" />
                        </span>
                      <?php } ?>
                    </td>
                  </tr>
                <?php }?>
                <tr>
                  <td colspan='4'>
                    <input class='btn btn-primary pull-right' type='submit' name='twoChange' value='Submit' />
                    <input type="hidden" value="<?=Token::generate();?>" name="csrf">
                  </td>
                </tr>
              <?php } else { ?>
                <tr><td><center>No Fingerprints Found</center></td></tr><?php } ?>
              </table>
            </div>
          </form><br />
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; ?>
<script>
$(function () {
  $('.button-checkbox').each(function () {

    // Settings
    var $widget = $(this),
    $button = $widget.find('button'),
    $checkbox = $widget.find('input:checkbox'),
    color = $button.data('color'),
    settings = {
      on: {
        icon: 'fa fa-check'
      },
      off: {
        icon: 'fa fa-times'
      }
    };

    // Event Handlers
    $button.on('click', function () {
      $checkbox.prop('checked', !$checkbox.is(':checked'));
      $checkbox.triggerHandler('change');
      updateDisplay();
    });
    $checkbox.on('change', function () {
      updateDisplay();
    });

    // Actions
    function updateDisplay() {
      var isChecked = $checkbox.is(':checked');

      // Set the button's state
      $button.data('state', (isChecked) ? "on" : "off");

      // Set the button's icon
      $button.find('.state-icon')
      .removeClass()
      .addClass('state-icon ' + settings[$button.data('state')].icon);

      // Update the button's color
      if (isChecked) {
        $button
        .removeClass('btn-default')
        .addClass('btn-' + color + ' active');
      }
      else {
        $button
        .removeClass('btn-' + color + ' active')
        .addClass('btn-default');
      }
    }

    // Initialization
    function init() {

      updateDisplay();

      // Inject the icon if applicable
      if ($button.find('.state-icon').length == 0) {
        $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
      }
    }
    init();
  });
});
</script>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>

<?php require_once '../users/init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>
<?php if (!securePage($_SERVER['PHP_SELF'])){die();}?>
<?php
if($settings->session_manager!=1) Redirect::to($us_url_root.'users/admin.php?err=Session Manager is not enabled.');
$showAllSessions = Input::get('showAllSessions');
$errors=[];
$successes=[];
if (!empty($_POST)) {
  $token = $_POST['csrf'];
  if(!Token::check($token)){
    include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
  }

  if(!empty($_POST['sessionChange'])) {

    if(isset($_POST['deleteAllSessions'])) {
      $db->query("TRUNCATE TABLE us_user_sessions");
      if(!$db->error()) {
        logger($user->data()->id,"User Tracker","Deleted all Session Records and reset the table.");
        $successes[] = "Deleted all sessions";
      } else {
        $error=$db->errorString();
        logger($user->data()->id,"User Tracker","Failure deleting all session records, Error: ".$error);
        $errors[] = "Failure deleting all sessions, Error: ".$error;
      }
    }

    if(isset($_POST['killAllSessions']) && in_array($user->data()->id,$master_account)) {
      $db->query("UPDATE us_user_sessions SET UserSessionEnded=1,UserSessionEnded_Time=NOW() WHERE UserSessionEnded=0 AND kUserSessionID <> ?",[$_SESSION['kUserSessionID']]);
      if(!$db->error()) {
        logger($user->data()->id,"User Tracker","Killed all Sessions.");
        $successes[] = "Killed all Sessions";
      } else {
        $error=$db->errorString();
        logger($user->data()->id,"User Tracker","Failure killing all sessions, Error: ".$error);
        $errors[] = "Failure killing all sessions, Error: ".$error;
      }
    }

    if(isset($_POST['killSession'])) {
      $sessions = Input::get('killSession');
      $kill = killSessions($sessions,true);
      if($kill) {
        if($kill==1) $successes[] = "Killed 1 Session";
        else $successes[] = "Killed $kill Sessions";
      }
    }
  }
}
?>

<div id="page-wrapper">
  <div class="container">
    <div class="well">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <h1>Session Administrator</h1>
          <hr>
          <?=resultBlock($errors,$successes);?>
          <form class="verify-admin" action="admin_manage_sessions.php" method="POST" id="payment-form">
            <h4>Active Sessions</h4>
            <table class="table table-bordered">
              <?php
              if($showAllSessions!=1) $sessions = fetchAdminSessions();
              else $sessions = fetchAdminSessions(true);
              if($sessions) { ?>
                <tr>
                  <th width="10%">User</th>
                  <th width="30%">Information</th>
                  <th width="15%">Recorded</th>
                  <th width="35%">Last Action</th>
                  <th width="10%">Kill</th>
                </tr>
                <?php foreach($sessions as $session) { ?>
                  <tr>
                    <td><?=echousername($session->fkUserID)?></td>
                    <td>
                        <?=$session->UserSessionBrowser?> on <?=$session->UserSessionOS?> <?php if($session->kUserSessionID==$_SESSION['kUserSessionID']) {?><sup>Current Session</sup><?php } ?><br>
                        <?php if($session->UserSessionIP!='::1') {
                           $geo = json_decode(file_get_contents("http://extreme-ip-lookup.com/json/$session->UserSessionIP"));
                           $country = $geo->country;
                           $city = $geo->city;
                           $ipType = $geo->ipType;
                           $businessName = $geo->businessName;
                           $businessWebsite = $geo->businessWebsite;

                           echo "Location of $session->UserSessionIP: $city, $country\n";
                        } ?>
                    </td>
                    <td><span class="show-tooltip" title="<?=date("D, M j, Y g:i:sa",strtotime($session->UserSessionStarted))?>"><?=time2str($session->UserSessionStarted)?></span></td>
                    <td><?=$session->UserSessionLastPage?> <span class="show-tooltip" title="<?=date("D, M j, Y g:i:sa",strtotime($session->UserSessionLastUsed))?>"><?=time2str($session->UserSessionLastUsed)?></span></td>
                    <td>
                      <?php if($session->kUserSessionID!=$_SESSION['kUserSessionID'] && $session->UserSessionEnded!=1) {?>
                        <span class="button-checkbox">
                          <button type="button" class="btn" data-color="warning">Delete</button>
                          <input type="checkbox" class="hidden" name="killSession[]" value="<?=$session->kUserSessionID?>" />
                        </span>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
                <tr>
                  <td colspan='4'>
                    <div class="col col-md-6">
                      <label><input type="checkbox" name="killAllSessions" id="killAllSessions" class="killAllSessions" value="1" <?php if(!in_array($user->data()->id,$master_account)) {?>disabled<?php } ?>/> Kill All Sessions</label>
                      <br><font color='red'><strong>Urgent / Attention</strong></font> This is an <strong>extremely</strong> powerful function and will almost instantly log every user on your site out. Any data entered and not saved will be instantly lost.
                    </div>

                    <div class="col col-md-6">
                      <label><input type="checkbox" name="deleteAllSessions" value="1" /> Delete All Sessions</label>
                      <br>This is less powerful version of the latter. No sessions will be logged out, however Session Data will be re-entered and the table will begin at ID #1 again.
                    </div>
                  </td>
                  <td>
                    <input class='btn btn-primary pull-right' type='submit' name='sessionChange' value='Submit' />
                    <input type="hidden" value="<?=Token::generate();?>" name="csrf">
                  </td>
                </tr>
              <?php } else { ?>
                <tr><td><center>No Fingerprints Found</center></td></tr><?php } ?>
              </table>
              <?php if($showAllSessions!=1) {?><a href="?showAllSessions=1" class="btn btn-primary nounderline pull-right">Show All Recorded Sessions</a><?php } ?>
              <?php if($showAllSessions==1) {?><a href="?" class="btn btn-primary nounderline pull-right">Show Active Sessions Only</a><?php } ?>
            </div>
          </form><br />
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js" integrity="sha256-4F7e4JsAJyLUdpP7Q8Sah866jCOhv72zU5E8lIRER4w=" crossorigin="anonymous"></script>
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
        icon: 'glyphicon glyphicon-check'
      },
      off: {
        icon: 'glyphicon glyphicon-unchecked'
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

$(document).on("click", ".killAllSessions", function(e) {
  if($(".killAllSessions").is(':checked')) {
    bootbox.confirm({
      size: "medium",
      message: "Are you sure you want to kill all sessions?",
      callback: function(result){
        if(result) {
          $('.killAllSessions').prop('checked', true);
        } else {
          $('.killAllSessions').prop('checked', false);
        }
      }
    })
  }
});
</script>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>

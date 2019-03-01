<div class="col-sm-8">
  <div class="page-header float-right">
    <div class="page-title">
        <ol class="breadcrumb text-right">
          <li><a href="<?=$us_url_root?>users/admin.php">Dashboard</a></li>
          <li>Tools</li>
          <li class="active">Sessions</li>
        </ol>
    </div>
  </div>
</div>
</div>
</header>
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

    if(isset($_POST['killSession'])) {
      $sessions = Input::get('killSession');
      $kill = killSessions($sessions);
      if($kill) {
        if($kill==1) $successes[] = "Killed 1 Session";
        else $successes[] = "Killed $kill Sessions";
      }
    }
  }
}
?>

<div class="content mt-3">
  <p><a href="../users/account.php" class="btn btn-primary">Account Home</a></p>
  <!-- <p><a href="../users/disable2fa.php" class="btn btn-primary">Disable 2FA</a></p> -->
  <h2>Manage Sessions</h2>
  <hr>
  <?=resultBlock($errors,$successes);?>
  <form class="verify-admin" action="admin.php?view=sessions" method="POST">
    <h4>Active Sessions</h4>
    <table class="table table-bordered">
      <?php
      if($showAllSessions!=1) $sessions = fetchUserSessions();
      else $sessions = fetchUserSessions(true);
      if($sessions) { ?>
        <tr>
          <th width="40%">Information</th>
          <th width="15%">Recorded</th>
          <th width="35%">Last Action</th>
          <th width="10%">Kill</th>
        </tr>
        <?php foreach($sessions as $session) { ?>
          <tr>
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
            <input class='btn btn-primary pull-right' type='submit' name='sessionChange' value='Submit' />
            <input type="hidden" value="<?=Token::generate();?>" name="csrf">
          </td>
        </tr>
      <?php } else { ?>
        <tr><td><center>No Fingerprints Found</center></td></tr><?php } ?>
      </table>
      <?php if($showAllSessions!=1) {?><a href="?showAllSessions=1" class="btn btn-primary nounderline pull-right">Show All Recorded Sessions</a><?php } ?>
      <?php if($showAllSessions==1) {?><a href="?" class="btn btn-primary nounderline pull-right">Show Active Sessions Only</a><?php } ?>
    </div><br />
  </form>

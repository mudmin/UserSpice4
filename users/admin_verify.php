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
<?php require_once '../users/init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
$lang = array_merge($lang,array(
    "ADMIN_VERIFY_NOREF"        => "There is no referrer, you cannot verify yourself. Please return to the Dashboard.",
    "INCORRECT_ADMINPW"         => "Incorrect credential, please try again",
    ));
$errors = $successes = [];
$form_valid=TRUE;
$current=date("Y-m-d H:i:s");
if(empty($_POST)) {
  $actual_link = Input::get('actual_link');
  $page = Input::get('page');
  if (empty($actual_link) || empty($page)) {
      $actual_link = '';
      $page = '';
      $errors[] = lang("ADMIN_VERIFY_NOREF");
      Redirect::to('../index.php');
  }
}
  if(isset($_SESSION['last_confirm']) && $_SESSION['last_confirm']!='' && !is_null($_SESSION['last_confirm'])) $last_confirm=$_SESSION['last_confirm'];
  else $last_confirm=date("Y-m-d H:i:s",strtotime("-3 hours",strtotime(date("Y-m-d H:i:s"))));
  $ctFormatted = date("Y-m-d H:i:s", strtotime($current));
  $dbPlus = date("Y-m-d H:i:s", strtotime('+2 hours', strtotime($last_confirm)));
  if (strtotime($ctFormatted) < strtotime($dbPlus)){
    Redirect::to(htmlspecialchars_decode($actual_link));
  }
if (!empty($_POST)) {
  $token = $_POST['csrf'];
  if(!Token::check($token)){
    include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
  }

  if(!empty($_POST['verifyAdmin'])) {
    $password=Input::get('password');
    $actual_link = Input::get('verify_uri');
    $page = Input::get('verify_page');
    if (password_verify($password,$user->data()->password) || password_verify($password,$user->data()->pin)) {
      $_SESSION['last_confirm']=date("Y-m-d H:i:s");
      logger($user->data()->id,"Admin Verification","Access granted to $page via password verification.");
      unset($_SESSION['reauth_count']);
      if(!empty($actual_link)){
          Redirect::to(htmlspecialchars_decode($actual_link));
      }
    } else {
    $errors[] = lang("INCORRECT_ADMINPW");
    if(isset($_SESSION['reauth_count']) && $_SESSION['reauth_count']==3) {
      logger($user->data()->id,"Admin Verification","3 failed verification attempts, logging out");
      Redirect::to('../users/logout.php');
    }
    if(isset($_SESSION['reauth_count'])) $_SESSION['reauth_count'] = $_SESSION['reauth_count']+1;
    else $_SESSION['reauth_count'] = 2;
    logger($user->data()->id,"Admin Verification","Access denied to $page via password verification due to invalid password.");
    }
  }
}

?>
<div id="page-wrapper">

  <div class="container">

    <!-- Page Heading -->
    <div class="row">
<?=resultBlock($errors,$successes);?>
<? if ($actual_link !='') { ?>
        <div class="col-xs-12 col-md-6">
        <h1>Restricted Access</h1>
        <p><font color='slate'>Please enter your <strong>password</strong> or <strong>PIN</strong> code below to continue</font></p>
      </div>

     </div>
    <div class="row">
    <form class="verify-admin" action="admin_verify.php" method="POST" id="payment-form">
    <div class="col-md-5">
    <div class="input-group"><input class="form-control" type="password" name="password" id="password" required autofocus>
        <span class="input-group-btn">
        <input class='btn btn-primary' type='submit' name='verifyAdmin' value='Verify' />
      </span></div>
    <input type="hidden" name="verify_uri" value="<?=$actual_link?>" />
    <input type="hidden" name="verify_page" value="<?=$page?>" />
    <input type="hidden" value="<?=Token::generate();?>" name="csrf">
    <? } ?>
    </div>
     </div>
   </form><br />
   </div>
   </div>


  </div>
</div>
    <!-- End of main content section -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

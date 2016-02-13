<?php
/*
UserSpice 43
by Dan Hoover at http://UserSpice.com
*/
?>
<?php require_once("includes/userspice/us_header.php"); ?>

<?php require_once("includes/userspice/us_navigation.php"); ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
// To make this panel super admin only, uncomment out the lines below
// if($user->data()->id !='1'){
//   Redirect::to('account.php');
// }

//PHP Goes Here!
delete_user_online(); //Deletes sessions older than 30 minutes
//Find users who have logged in in X amount of time.
$date = date("Y-m-d H:i:s");
// echo $date."<br>";
$hour = date("Y-m-d H:i:s", strtotime("-1 hour", strtotime($date)));
$today = date("Y-m-d H:i:s", strtotime("-1 day", strtotime($date)));
$week = date("Y-m-d H:i:s", strtotime("-1 week", strtotime($date)));
$month = date("Y-m-d H:i:s", strtotime("-1 month", strtotime($date)));

$usersHourQ = $db->query("SELECT * FROM users WHERE last_login > ?",array($hour));
$usersHour = $usersHourQ->results();
$hourCount = $usersHourQ->count();

$usersTodayQ = $db->query("SELECT username FROM users WHERE last_login > ?",array($today));
$dayCount = $usersTodayQ->count();

$usersWeekQ = $db->query("SELECT username FROM users WHERE last_login > ?",array($week));
$weekCount = $usersWeekQ->count();

$usersMonthQ = $db->query("SELECT username FROM users WHERE last_login > ?",array($month));
$monthCount = $usersMonthQ->count();

$usersQ = $db->query("SELECT * FROM users");
$user_count = $usersQ->count();

$pagesQ = $db->query("SELECT * FROM pages");
$page_count = $pagesQ->count();

$levelsQ = $db->query("SELECT * FROM permissions");
$level_count = $levelsQ->count();

$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();

if(!empty($_POST['settings'])){
  $token = $_POST['csrf'];
	if(!Token::check($token)){
		die('Token doesn\'t match!');
	}
if($settings->recaptcha != $_POST['recaptcha']) {
  $recaptcha = Input::get('recaptcha');
  $fields=array('recaptcha'=>$recaptcha);
  $db->update('settings',1,$fields);
}
if($settings->site_name != $_POST['site_name']) {
  $site_name = Input::get('site_name');
  $fields=array('site_name'=>$site_name);
  $db->update('settings',1,$fields);
}
if($settings->login_type != $_POST['login_type']) {
  $login_type = Input::get('login_type');
  $fields=array('login_type'=>$login_type);
  $db->update('settings',1,$fields);
}
if($settings->force_ssl != $_POST['force_ssl']) {
  $force_ssl = Input::get('force_ssl');
  $fields=array('force_ssl'=>$force_ssl);
  $db->update('settings',1,$fields);
}
if($settings->force_pr != $_POST['force_pr']) {
  $force_pr = Input::get('force_pr');
  $fields=array('force_pr'=>$force_pr);
  $db->update('settings',1,$fields);
}
if($settings->site_offline != $_POST['site_offline']) {
  $site_offline = Input::get('site_offline');
  $fields=array('site_offline'=>$site_offline);
  $db->update('settings',1,$fields);
}
if($settings->track_guest != $_POST['track_guest']) {
  $track_guest = Input::get('track_guest');
  $fields=array('track_guest'=>$track_guest);
  $db->update('settings',1,$fields);
}

Redirect::to('admin.php');
}

if(!empty($_POST)){

  if($settings->us_css1 != $_POST['us_css1']) {
    $us_css1 = Input::get('us_css1');
    $fields=array('us_css1'=>$us_css1);
    $db->update('settings',1,$fields);
  }
  if($settings->us_css2 != $_POST['us_css2']) {
    $us_css2 = Input::get('us_css2');
    $fields=array('us_css2'=>$us_css2);
    $db->update('settings',1,$fields);
  }

if($settings->us_css3 != $_POST['us_css3']) {
  $us_css3 = Input::get('us_css3');
  $fields=array('us_css3'=>$us_css3);
  $db->update('settings',1,$fields);
}
if($settings->css1 != $_POST['css1']) {
  $css1 = Input::get('css1');
  $fields=array('css1'=>$css1);
  $db->update('settings',1,$fields);
}
if($settings->css2 != $_POST['css2']) {
  $css2 = Input::get('css2');
  $fields=array('css2'=>$css2);
  $db->update('settings',1,$fields);
}
if($settings->css3 != $_POST['css3']) {
  $css3 = Input::get('css3');
  $fields=array('css3'=>$css3);
  $db->update('settings',1,$fields);
}

Redirect::to('admin.php');
}

?>
<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          Administrator Control Panel
        </h1>
    </div>

    <!-- /.row -->
<?php
// $date = date("Y-m-d H:i:s");
// echo $date;
// $thirtyMin = $date = strtotime(date('Y-m-d H:i:s') . ' -30 minutes');
// echo $thirtyMin;
// $date = new DateTime();
// echo $date->format("d-m-Y H:i:s").'<br />';

// $date = date("Y-m-d H:i:s");
// echo $date."<br>";
// $datetime_from = date("Y-m-d H:i:s", strtotime("-45 minutes", strtotime($date)));
// echo $datetime_from;
?>
<!-- Top Admin Panels -->
<?php require_once("views/admin_panel/_top_panels.php");?>
<?php require_once("views/admin_panel/_css_settings.php");?>
<?php require_once("views/admin_panel/_main_settings.php");?>

    <!-- footers -->
    <?php require_once("includes/userspice/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

    <?php require_once("includes/userspice/us_html_footer.php"); // currently just the closing /body and /html ?>

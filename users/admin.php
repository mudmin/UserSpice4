<?php
/*
UserSpice 4
An Open Source PHP User Management System
by Curtis Parham and Dan Hoover at http://UserSpice.com

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
<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

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

$usersTodayQ = $db->query("SELECT * FROM users WHERE last_login > ?",array($today));
$dayCount = $usersTodayQ->count();
$usersDay = $usersTodayQ->results();

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
  if($settings->css_sample != $_POST['css_sample']) {
    $css_sample = Input::get('css_sample');
    $fields=array('css_sample'=>$css_sample);
    $db->update('settings',1,$fields);
  }

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
<div id="page-wrapper"> <!-- leave in place for full-screen backgrounds etc -->

  <div class="container"> <!-- -fluid -->

    <!-- Page Heading -->
	<div class="row">
		<div class="col-md-4">
			<h1 class="hidden-xs ">Dashboard</h1>
			<h1 class="visible-xs ">Dash</h1>
		</div>

		<div class="col-md-8">
		<h1 class="pull-right"></h1>
		</div>
	</div>
	<!-- Top Admin Panels -->
	<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs " role="tablist">
    <li class="active"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" >Activity</a></li>
    <li ><a href="#settings2" aria-controls="settings2" role="tab" data-toggle="tab">Main Settings</a></li>
    <li ><a href="#css" aria-controls="css" role="tab" data-toggle="tab">Choose CSS</a></li>
  </ul>
  <!-- Tab panes -->
	<div class="tab-content us-dash-panels">
		<div role="tabpanel" class="tab-pane active" id="settings">	<?php require_once("views/admin_panel/_top_panels.php");?><?php require_once("views/admin_panel/_main_settings.php");?>		<div id="times"></div></div>
		<div role="tabpanel" class="tab-pane" id="settings2"><?php require_once("views/admin_panel/_main_settings2.php");?></div>
		<div role="tabpanel" class="tab-pane" id="css">
			<?php require_once("views/admin_panel/_css_settings.php");?>
			<?php if($settings->css_sample == 1){require_once("views/admin_panel/_css_test.php");}?>
		</div>
	   </div>
	</div>
    </div> <!-- /container -->
</div> <!-- /#page-wrapper -->


<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->
	<script type="text/javascript">
	$(document).ready(function(){

	$("#times").load("times.php" );

	var timesRefresh = setInterval(function(){
	$("#times").load("times.php" );
	}, 30000);


  $('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();
// -------------------------------------------------------------------------
		});
	</script>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

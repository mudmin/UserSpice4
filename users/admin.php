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
delete_user_online(); //Deletes sessions older than 24 hours

//Find users who have logged in in X amount of time.
$date = date("Y-m-d H:i:s");

$hour = date("Y-m-d H:i:s", strtotime("-1 hour", strtotime($date)));
$today = date("Y-m-d H:i:s", strtotime("-1 day", strtotime($date)));
$week = date("Y-m-d H:i:s", strtotime("-1 week", strtotime($date)));
$month = date("Y-m-d H:i:s", strtotime("-1 month", strtotime($date)));

$last24=time()-86400;

$recentUsersQ = $db->query("SELECT * FROM users_online WHERE timestamp > ? ORDER BY timestamp DESC",array($last24));
$recentUsersCount = $recentUsersQ->count();
$recentUsers = $recentUsersQ->results();

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

$tomC = $db->query("SELECT * FROM audit")->count();

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

	if($settings->messaging != $_POST['messaging']) {
		$messaging = Input::get('messaging');
		$fields=array('messaging'=>$messaging);
		$db->update('settings',1,$fields);
	}

	if($settings->echouser != $_POST['echouser']) {
		$echouser = Input::get('echouser');
		$fields=array('echouser'=>$echouser);
		$db->update('settings',1,$fields);
	}

	if($settings->wys != $_POST['wys']) {
		$wys = Input::get('wys');
		$fields=array('wys'=>$wys);
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

if(!empty($_POST['css'])){
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
	Redirect::to('admin.php');
}

if(!empty($_POST['social'])){

		if($settings->change_un != $_POST['change_un']) {
		$change_un = Input::get('change_un');
		$fields=array('change_un'=>$change_un);
		$db->update('settings',1,$fields);
	}

	if($settings->req_cap != $_POST['req_cap']) {
		$req_cap = Input::get('req_cap');
		$fields=array('req_cap'=>$req_cap);
		$db->update('settings',1,$fields);
	}

	if($settings->req_num != $_POST['req_num']) {
		$req_num = Input::get('req_num');
		$fields=array('req_num'=>$req_num);
		$db->update('settings',1,$fields);
	}

	if($settings->min_pw != $_POST['min_pw']) {
		$min_pw = Input::get('min_pw');
		$fields=array('min_pw'=>$min_pw);
		$db->update('settings',1,$fields);
	}

	if($settings->max_pw != $_POST['max_pw']) {
		$max_pw = Input::get('max_pw');
		$fields=array('max_pw'=>$max_pw);
		$db->update('settings',1,$fields);
	}

	if($settings->min_un != $_POST['min_un']) {
		$min_un = Input::get('min_un');
		$fields=array('min_un'=>$min_un);
		$db->update('settings',1,$fields);
	}

	if($settings->max_un != $_POST['max_un']) {
		$max_un = Input::get('max_un');
		$fields=array('max_un'=>$max_un);
		$db->update('settings',1,$fields);
	}

	if($settings->glogin != $_POST['glogin']) {
		$glogin = Input::get('glogin');
		$fields=array('glogin'=>$glogin);
		$db->update('settings',1,$fields);
	}

	if($settings->fblogin != $_POST['fblogin']) {
		$fblogin = Input::get('fblogin');
		$fields=array('fblogin'=>$fblogin);
		$db->update('settings',1,$fields);
	}

	if($settings->gid != $_POST['gid']) {
		$gid = Input::get('gid');
		$fields=array('gid'=>$gid);
		$db->update('settings',1,$fields);
	}

	if($settings->gsecret != $_POST['gsecret']) {
		$gsecret = Input::get('gsecret');
		$fields=array('gsecret'=>$gsecret);
		$db->update('settings',1,$fields);
	}

	if($settings->gredirect != $_POST['gredirect']) {
		$gredirect = Input::get('gredirect');
		$fields=array('gredirect'=>$gredirect);
		$db->update('settings',1,$fields);
	}

	if($settings->ghome != $_POST['ghome']) {
		$ghome = Input::get('ghome');
		$fields=array('ghome'=>$ghome);
		$db->update('settings',1,$fields);
	}

	if($settings->fbid != $_POST['fbid']) {
		$fbid = Input::get('fbid');
		$fields=array('fbid'=>$fbid);
		$db->update('settings',1,$fields);
	}

	if($settings->fbsecret != $_POST['fbsecret']) {
		$fbsecret = Input::get('fbsecret');
		$fields=array('fbsecret'=>$fbsecret);
		$db->update('settings',1,$fields);
	}

	if($settings->fbcallback != $_POST['fbcallback']) {
		$fbcallback = Input::get('fbcallback');
		$fields=array('fbcallback'=>$fbcallback);
		$db->update('settings',1,$fields);
	}

	if($settings->graph_ver != $_POST['graph_ver']) {
		$graph_ver = Input::get('graph_ver');
		$fields=array('graph_ver'=>$graph_ver);
		$db->update('settings',1,$fields);
	}

	if($settings->finalredir != $_POST['finalredir']) {
		$finalredir = Input::get('finalredir');
		$fields=array('finalredir'=>$finalredir);
		$db->update('settings',1,$fields);
	}

	Redirect::to('admin.php');
}

?>
<div id="page-wrapper"> <!-- leave in place for full-screen backgrounds etc -->
<div class="container"> <!-- -fluid -->

<h1 class="text-center">UserSpice Dashboard Version <?=$user_spice_ver?></h1>
<p class="text-center"><a href="check_updates.php">(Check for Updates)</a></p>

<div class="row"> <!-- row for Users, Permissions, Pages, Email settings panels -->
	<h2>Admin Panels</h2>
	<!-- Users Panel -->
	<div class="col-xs-6 col-md-3">
	<div class="panel panel-default">
	<div class="panel-heading"><strong>Users</strong></div>
	<div class="panel-body text-center"><div class="huge"> <i class='fa fa-user fa-1x'></i> <?=$user_count?></div></div>
	<div class="panel-footer">
	<span class="pull-left"><a href="admin_users.php">Manage</a></span>
	<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	<div class="clearfix"></div>
	</div> <!-- /panel-footer -->
	</div><!-- /panel -->
	</div><!-- /col -->

	<!-- Permissions Panel -->
	<div class="col-xs-6 col-md-3">
	<div class="panel panel-default">
	<div class="panel-heading"><strong>Permission Levels</strong></div>
	<div class="panel-body text-center"><div class="huge"> <i class='fa fa-lock fa-1x'></i> <?=$level_count?></div></div>
	<div class="panel-footer">
	<span class="pull-left"><a href="admin_permissions.php">Manage</a></span>
	<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	<div class="clearfix"></div>
	</div> <!-- /panel-footer -->
	</div><!-- /panel -->
	</div> <!-- /.col -->

	<!-- Pages Panel -->
	<div class="col-xs-6 col-md-3">
	<div class="panel panel-default">
	<div class="panel-heading"><strong>Pages</strong></div>
	<div class="panel-body  text-center"><div class="huge"> <i class='fa fa-file-text fa-1x'></i> <?=$page_count?></div></div>
	<div class="panel-footer">
	<span class="pull-left"><a href="admin_pages.php">Manage</a></span>
	<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	<div class="clearfix"></div>
	</div> <!-- /panel-footer -->
	</div><!-- /panel -->
	</div><!-- /col -->

	<!-- Email Settings Panel -->
	<div class="col-xs-6 col-md-3">
	<div class="panel panel-default">
	<div class="panel-heading"><strong>Email Settings</strong></div>
	<div class="panel-body text-center"><div class="huge"> <i class='fa fa-paper-plane fa-1x'></i> 9</div></div>
	<div class="panel-footer">
	<span class="pull-left"><a href='email_settings.php'>Manage</a></span>
	<span class="pull-right"><i class='fa fa-arrow-circle-right'></i></span>
	<div class="clearfix"></div>
	</div> <!-- /panel-footer -->
	</div> <!-- /panel -->
	</div> <!-- /col -->

</div> <!-- /.row -->

<!-- CHECK IF ADDITIONAL ADMIN PAGES ARE PRESENT AND INCLUDE IF AVAILABLE -->

<?php
if(file_exists($abs_us_root.$us_url_root.'usersc/includes/admin_panels.php')){
	require_once $abs_us_root.$us_url_root.'usersc/includes/admin_panels.php';
}
?>

<!-- /CHECK IF ADDITIONAL ADMIN PAGES ARE PRESENT AND INCLUDE IF AVAILABLE -->

<div class="row "> <!-- rows for Info Panels -->
	<h2>Info Panels</h2>
	<div class="col-xs-12 col-md-6">
	<div class="panel panel-default">
	<div class="panel-heading"><strong>All Users</strong> <span class="small">(Who have logged in)</span></div>
	<div class="panel-body text-center">
	<div class="row">
		<div class="col-xs-3 "><h3><?=$hourCount?></h3><p>per hour</p></div>
		<div class="col-xs-3"><h3><?=$dayCount?></h3><p>per day</p></div>
		<div class="col-xs-3 "><h3><?=$weekCount?></h3><p>per week</p></div>
		<div class="col-xs-3 "><h3><?=$monthCount?></h3><p>per month</p></div>
	</div>
	</div>
	</div><!--/panel-->


	<div class="panel panel-default">
	<div class="panel-heading"><strong>All Visitors</strong> <span class="small">(Whether logged in or not)</span></div>
	<div class="panel-body">
	<?php  if($settings->track_guest == 1){ ?>
	<?="In the last 30 minutes, the unique visitor count was ".count_users()."<br>";?>
	<?php }else{ ?>
	Guest tracking off. Turn "Track Guests" on below for advanced tracking statistics.
	<?php } ?>
	</div>
	</div><!--/panel-->

	</div> <!-- /col -->

	<div class="col-xs-12 col-md-6">
	<div class="panel panel-default">
	<div class="panel-heading"><strong>Logged In Users</strong> <span class="small">(past 24 hours)</span></div>
	<div class="panel-body">
	<div class="uvistable table-responsive">
	<table class="table">
	<?php if($settings->track_guest == 1){ ?>
	<thead><tr><th>Username</th><th>IP</th><th>Last Activity</th></tr></thead>
	<tbody>

	<?php foreach($recentUsers as $v1){
		$user_id=$v1->user_id;
		$username=name_from_id($v1->user_id);
		$timestamp=date("Y-m-d H:i:s",$v1->timestamp);
		$ip=$v1->ip;

		if ($user_id==0){
			$username="guest";
		}

		if ($user_id==0){?>
			<tr><td><?=$username?></td><td><?=$ip?></td><td><?=$timestamp?></td></tr>
		<?php }else{ ?>
			<tr><td><a href="admin_user.php?id=<?=$user_id?>"><?=$username?></a></td><td><?=$ip?></td><td><?=$timestamp?></td></tr>
		<?php } ?>

	<?php } ?>

	</tbody>
	<?php }else{echo 'Guest tracking off. Turn "Track Guests" on below for advanced tracking statistics.';} ?>
	</table>
	</div>
	</div>
	</div><!--/panel-->

	<div class="panel panel-default">
	<div class="panel-heading"><strong>Security Events</strong><span align="right" class="small"><a href="tomfoolery.php"> (View Logs)</a></span></div>
	<div class="panel-body" align="center">
	There have been<br>
	<h2><?=$tomC?></h2>
	security events triggered
	</div>
	</div><!--/panel-->


	</div> <!-- /col2/2 -->
</div> <!-- /row -->


<div class="row"> <!-- rows for Main Settings -->
	<div class="col-xs-12 col-md-6"> <!-- Site Settings Column -->
		<form class="" action="admin.php" name="settings" method="post">
		<h2 >Site Settings</h2>

		<!-- List group -->

		<!-- Site Name -->
		<div class="form-group">
		<label for="site_name">Site Name</label>
		<input type="text" class="form-control" name="site_name" id="site_name" value="<?=$settings->site_name?>">
		</div>

		<!-- Recaptcha Option -->
		<div class="form-group">
			<label for="recaptcha">Recaptcha</label>
			<select id="recaptcha" class="form-control" name="recaptcha">
				<option value="1" <?php if($settings->recaptcha==1) echo 'selected="selected"'; ?> >Enabled</option>
				<option value="0" <?php if($settings->recaptcha==0) echo 'selected="selected"'; ?> >Disabled</option>
				<option value="2" <?php if($settings->recaptcha==2) echo 'selected="selected"'; ?> >For Join Only</option>
			</select>
		</div>

		<!-- Messaging Option -->
		<div class="form-group">
			<label for="messaging">Messaging (Experimental)</label>
			<select id="messaging" class="form-control" name="messaging">
				<option value="1" <?php if($settings->messaging==1) echo 'selected="selected"'; ?> >Enabled</option>
				<option value="0" <?php if($settings->messaging==0) echo 'selected="selected"'; ?> >Disabled</option>
			</select>
		</div>

		<!-- echouser Option -->
		<div class="form-group">
			<label for="echouser">echouser Function</label>
			<select id="echouser" class="form-control" name="echouser">
				<option value="0" <?php if($settings->echouser==0) echo 'selected="selected"'; ?> >FName LName</option>
				<option value="1" <?php if($settings->echouser==1) echo 'selected="selected"'; ?> >Username</option>
				<option value="2" <?php if($settings->echouser==2) echo 'selected="selected"'; ?> >Username (FName LName)</option>
				<option value="3" <?php if($settings->echouser==3) echo 'selected="selected"'; ?> >Username (FName)</option>
			</select>
		</div>

		<!-- WYSIWYG Option -->
		<div class="form-group">
			<label for="wys">WYSIWYG Editor</label>
			<select id="wys" class="form-control" name="wys">
				<option value="0" <?php if($settings->wys==0) echo 'selected="selected"'; ?> >Disabled</option>
				<option value="1" <?php if($settings->wys==1) echo 'selected="selected"'; ?> >Enabled</option>
			</select>
		</div>

		<!-- Force SSL -->
		<div class="form-group">
			<label for="force_ssl">Force HTTPS Connections</label>
			<select id="force_ssl" class="form-control" name="force_ssl">
				<option value="1" <?php if($settings->force_ssl==1) echo 'selected="selected"'; ?> >Yes</option>
				<option value="0" <?php if($settings->force_ssl==0) echo 'selected="selected"'; ?> >No</option>
			</select>
		</div>

		<!-- Force Password Reset -->
		<div class="form-group">
			<label for="force_pr">Force Password Reset (disabled)</label>
			<select id="force_pr" class="form-control" name="force_pr" disabled>
				<option value="1" <?php if($settings->force_pr==1) echo 'selected="selected"'; ?> >Yes</option>
				<option value="0" <?php if($settings->force_pr==0) echo 'selected="selected"'; ?> >No</option>
			</select>
		</div>

		<!-- Site Offline -->
		<div class="form-group">
			<label for="site_offline">Site Offline</label>
			<select id="site_offline" class="form-control" name="site_offline">
				<option value="1" <?php if($settings->site_offline==1) echo 'selected="selected"'; ?> >Yes</option>
				<option value="0" <?php if($settings->site_offline==0) echo 'selected="selected"'; ?> >No</option>
			</select>
		</div>

		<!-- Track Guests -->
		<div class="form-group">
			<label for="track_guest">Track Guests</label>
			<select id="track_guest" class="form-control" name="track_guest">
				<option value="1" <?php if($settings->track_guest==1) echo 'selected="selected"'; ?> >Yes</option>
				<option value="0" <?php if($settings->track_guest==0) echo 'selected="selected"'; ?> >No</option>
			</select><small>If your site gets a lot of traffic and starts to stumble, this is the first thing to turn off.</small>
		</div>

		<input type="hidden" name="csrf" value="<?=Token::generate();?>" />

		<p><input class='btn btn-primary' type='submit' name="settings" value='Save Site Settings' /></p>
		</form>
	</div> <!-- /col1/2 -->

	<div class="col-xs-12 col-md-6"><!-- CSS Settings Column -->
		<form class="" action="admin.php" name="css" method="post">
		<!-- Test CSS Settings -->
		<h2>Sitewide CSS</h2>

		<div class="form-group">
			<label for="css_sample">Show CSS Samples</label>
			<select id="css_sample" class="form-control" name="css_sample">
				<option value="1" <?php if($settings->css_sample==1) echo 'selected="selected"'; ?> >Enabled</option>
				<option value="0" <?php if($settings->css_sample==0) echo 'selected="selected"'; ?> >Disabled</option>
			</select>
		</div>

		<div class="form-group">
			<label for="us_css1">Primary Color Scheme (Loaded 1st)</label>
			<select class="form-control" name="us_css1" id="us_css1" >
				<option selected="selected"><?=$settings->us_css1?></option>
				<?php
				$css_userspice=glob('../users/css/color_schemes/*.css');
				$css_custom=glob('../usersc/css/color_schemes/*.css');
				foreach(array_merge($css_userspice,$css_custom) as $filename){
				echo "<option value=".$filename.">".$filename."";
				}
				?>
			</select>
		</div>

		<div class="form-group">
			<label for="us_css2">Secondary UserSpice CSS (Loaded 2nd)</label>
			<select class="form-control" name="us_css2" id="us_css2">
				<option selected="selected"><?=$settings->us_css2?></option>
				<?php
				$css_userspice=glob('../users/css/*.css');
				$css_custom=glob('../usersc/css/*.css');
				foreach(array_merge($css_userspice,$css_custom) as $filename){
				echo "<option value=".$filename.">".$filename."";
				}
				?>
			</select>
		</div>

		<div class="form-group">
			<label for="us_css3">Custom UserSpice CSS (Loaded 3rd)</label>
			<select class="form-control" name="us_css3" id="us_css3">
				<option selected="selected"><?=$settings->us_css3?></option>
				<?php
				$css_userspice=glob('../users/css/*.css');
				$css_custom=glob('../usersc/css/*.css');
				foreach(array_merge($css_userspice,$css_custom) as $filename){
				echo "<option value=".$filename.">".$filename."";
				}
				?>
			</select>
		</div>

		<p><input class='btn btn-large btn-primary' type='submit' name="css" value='Save CSS Settings'/></p>
		</form>
	</div> <!-- /col1/3 -->
</div> <!-- /row -->

<!-- Social Login -->
<div class="col-xs-12 col-md-12">
	<form class="" action="admin.php" name="social" method="post">
	<h2>Register and Login Settings</h2>
<strong>Please note:</strong> Social logins require that you do some configuration on your own with Google and/or Facebook.<br>It is strongly recommended that you <a href="http://www.userspice.com/documentation-social-logins/">check the documentation at UserSpice.com.</a><br><br>
<!-- Allow users to change Usernames -->
<div class="form-group">
	<label for="change_un">Allow users to change their Usernames</label>
	<select id="change_un" class="form-control" name="change_un">
		<option value="0" <?php if($settings->change_un==0) echo 'selected="selected"'; ?> >Disabled</option>
		<option value="1" <?php if($settings->change_un==1) echo 'selected="selected"'; ?> >Enabled</option>
		<option value="2" <?php if($settings->change_un==2) echo 'selected="selected"'; ?> >Only once</option>
	</select>
</div>
<div class="form-group">
	<label for="min_pw">Minimum Password Length</label>
	<input type="text" class="form-control" name="min_pw" id="min_pw" value="<?=$settings->min_pw?>">
</div>
<div class="form-group">
	<label for="max_pw">Maximum Password Length</label>
	<input type="text" class="form-control" name="max_pw" id="max_pw" value="<?=$settings->max_pw?>">
</div>
<div class="form-group">
	<label for="req_num">Recommend a Number in the Password? (1=Yes)</label>
	<input type="text" class="form-control" name="req_num" id="req_num" value="<?=$settings->req_num?>">
</div>
<div class="form-group">
	<label for="req_cap">Recommend a Capital Letter in the Password? (1=Yes)</label>
	<input type="text" class="form-control" name="req_cap" id="req_cap" value="<?=$settings->req_cap?>">
</div>
<div class="form-group">
	<label for="min_un">Minimum Username Length</label>
	<input type="text" class="form-control" name="min_un" id="min_un" value="<?=$settings->min_un?>">
</div>
<div class="form-group">
	<label for="max_un">Maximum Username Length</label>
	<input type="text" class="form-control" name="max_un" id="max_un" value="<?=$settings->max_un?>">
</div>

	<div class="form-group">
		<label for="glogin">Enable Google Login</label>
		<select id="glogin" class="form-control" name="glogin">
			<option value="1" <?php if($settings->glogin==1) echo 'selected="selected"'; ?> >Enabled</option>
			<option value="0" <?php if($settings->glogin==0) echo 'selected="selected"'; ?> >Disabled</option>
		</select>
	</div>

	<div class="form-group">
		<label for="fblogin">Enable Facebook Login</label>
		<select id="fblogin" class="form-control" name="fblogin">
			<option value="1" <?php if($settings->fblogin==1) echo 'selected="selected"'; ?> >Enabled</option>
			<option value="0" <?php if($settings->fblogin==0) echo 'selected="selected"'; ?> >Disabled</option>
		</select>
	</div>

	<div class="form-group">
		<label for="gid">Google Client ID</label>
		<input type="text" class="form-control" name="gid" id="gid" value="<?=$settings->gid?>">
	</div>

	<div class="form-group">
		<label for="gsecret">Google Client Secret</label>
		<input type="text" class="form-control" name="gsecret" id="gsecret" value="<?=$settings->gsecret?>">
	</div>

	<div class="form-group">
		<label for="ghome">Full Home URL of Website - include the final /</label>
		<input type="text" class="form-control" name="ghome" id="ghome" value="<?=$settings->ghome?>">
	</div>

	<div class="form-group">
		<label for="gredirect">Google Redirect URL (Path to oauth_success.php)</label>
		<input type="text" class="form-control" name="gredirect" id="gredirect" value="<?=$settings->gredirect?>">
	</div>

	<div class="form-group">
		<label for="fbid">Facebook App ID</label>
		<input type="text" class="form-control" name="fbid" id="fbid" value="<?=$settings->fbid?>">
	</div>

	<div class="form-group">
		<label for="fbsecret">Facebook Secret</label>
		<input type="text" class="form-control" name="fbsecret" id="fbsecret" value="<?=$settings->fbsecret?>">
	</div>

	<div class="form-group">
		<label for="fbcallback">Facebook Callback URL</label>
		<input type="text" class="form-control" name="fbcallback" id="fbcallback" value="<?=$settings->fbcallback?>">
	</div>

	<div class="form-group">
		<label for="graph_ver">Facebook Graph Version - Formatted as v2.2</label>
		<input type="text" class="form-control" name="graph_ver" id="graph_ver" value="<?=$settings->graph_ver?>">
	</div>

	<div class="form-group">
		<label for="finalredir">Redirect After Facebook Login</label>
		<input type="text" class="form-control" name="finalredir" id="finalredir" value="<?=$settings->finalredir?>">
	</div>

	<p><input class='btn btn-large btn-primary' type='submit' name="social" value='Save Register and Login Settings'/></p>
	</form>
</div> <!-- /col1/3 -->
</div> <!-- /row -->



<?php if ($settings->css_sample){?>
<div class="row">

	<div class="col-md-12 text-center">
	<h2>Bootstrap Class Examples</h2>
	<hr />
	<button type="button" name="button" class="btn btn-primary">primary</button>
	<button type="button" name="button" class="btn btn-info">info</button>
	<button type="button" name="button" class="btn btn-warning">warning</button>
	<button type="button" name="button" class="btn btn-danger">danger</button>
	<button type="button" name="button" class="btn btn-success">success</button>
	<button type="button" name="button" class="btn btn-default">default</button>
	<hr />
	<div class="jumbotron"><h1>Jumbotron</h1></div>
	<div class="well"><p>well</p></div>
	<h1>This is H1</h1>
	<h2>This is H2</h2>
	<h3>This is H3</h3>
	<h4>This is H4</h4>
	<h5>This is H5</h5>
	<h6>This is H6</h6>
	<p>This is paragraph</p>
	<a href="#">This is a link</a><br><br>

	</div>
</div>
<?php } ?>






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

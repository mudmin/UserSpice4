<?php
/*
UserSpice 4
by Dan Hoover at http://UserSpice.com
*/
?>
<?php require_once("includes/us_header.php"); ?>

<?php require_once("includes/us_navigation.php"); ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
// To make this panel super admin only, uncomment out the lines below
// if($user->data()->id !='1'){
//   Redirect::to('account.php');
// }

//PHP Goes Here!
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
    </div>

    <!-- /.row -->


    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-file-text fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                You have
                <?php
                echo  "<div class='huge'>{$page_count}</div>"
                ?>
                <div>Pages</div>
              </div>
            </div>
          </div>
          <a href="admin_pages.php">
            <div class="panel-footer">
              <span class="pull-left">Manage Them</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-lock fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                You have
                <?php
                echo  "<div class='huge'>{$level_count}</div>"
                ?>
                <div>Permission Levels</div>
              </div>
            </div>
          </div>
          <a href="admin_permissions.php">
            <div class="panel-footer">
              <span class="pull-left">Manage Them</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                You have
                <?php
                echo  "<div class='huge'>{$user_count}</div>"
                ?>
                <div> Users</div>
              </div>
            </div>
          </div>
          <a href="admin_users.php">
            <div class="panel-footer">
              <span class="pull-left">Manage Them</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-paper-plane fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                You have

                <div class='huge'>9</div>

                <div>Email Settings</div>
              </div>
            </div>
          </div>
          <?php if($user->data()->id==1){ ?>
            <a href='email_settings.php'>
              <div class='panel-footer'>
                <span class='pull-left'>
                  Manage Them</span>
                  <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                  <div class='clearfix'></div>
                </div>
              </a>
              <?php }else{ ?>
                <div class='panel-footer'>
                  <span class='pull-left'>
                    Restricted Area</span>
                    <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                    <div class='clearfix'></div>
                  </div>
                  <?php } ?>


                </div>
              </div>
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-1 col-md-offset-1">
                <div class="panel panel-default">
                  <!-- Default panel contents -->
                  <form class="" action="admin.php" name="settings" method="post">

                    <input class='btn btn-danger' type='submit' name="settings" value='Update Settings' class='submit' />

                    <div class="panel-heading" align="center"><strong ><h4 >UserSpice Settings</h4>(some are not working yet!) </strong></div>

  <!-- List group -->
  <table class="table table-striped">
   <thead>
     <tr>
       <th>Option</th>
       <th>Setting</th>
     </tr>
   </thead>
   <tbody>

     <!-- Site Name -->
<tr>
<td><label for="site_name">Site Name</label></td>
<td>
<input type="text" class="form-control" name="site_name" id="site_name" value="<?=$settings->site_name?>">
</td>
</tr>
     <!-- Recaptcha Option -->
<tr>
<td><label for="recaptcha">Recaptcha</label></td>
<td><select id="recaptcha" class="form-control" name="recaptcha">
  <option value="1" <?php if($settings->recaptcha==1) echo 'selected="selected"'; ?> >Enabled</option>
<option value="0" <?php if($settings->recaptcha==0) echo 'selected="selected"'; ?> >Disabled</option>
<label for="recaptcha" class="form-control"></label></select></td>
</tr>

<!-- Login Via Username or Email -->
<tr>
<td><label for="login_type">Login Using (disabled)</label></td>
<td><select id="login_type" class="form-control" name="login_type">
<option value="email" <?php if($settings->login_type=='email') echo 'selected="selected"'; ?> >Email</option>
<option value="username" <?php if($settings->login_type=='username') echo 'selected="selected"'; ?> >Username</option>
<label for="login_type" class="form-control"></label></select></td>
</tr>

<!-- Force SSL -->
<tr>
<td><label for="force_ssl">Force SSL (disabled)</label></td>
<td><select id="force_ssl" class="form-control" name="force_ssl">
<option value="1" <?php if($settings->force_ssl==1) echo 'selected="selected"'; ?> >Yes</option>
<option value="0" <?php if($settings->force_ssl==0) echo 'selected="selected"'; ?> >No</option>
<label for="force_ssl" class="form-control"></label></select></td>
</tr>

<!-- Force Password Reset -->
<tr>
<td><label for="force_pr">Force Password Reset (disabled)</label></td>
<td><select id="force_pr" class="form-control" name="force_pr">
<option value="1" <?php if($settings->force_pr==1) echo 'selected="selected"'; ?> >Yes</option>
<option value="0" <?php if($settings->force_pr==0) echo 'selected="selected"'; ?> >No</option>
<label for="force_pr" class="form-control"></label></select></td>
</tr>

<!-- Site Offline -->
<tr>
<td><label for="site_offline">Site Offline</label></td>
<td><select id="site_offline" class="form-control" name="site_offline">
<option value="1" <?php if($settings->site_offline==1) echo 'selected="selected"'; ?> >Yes</option>
<option value="0" <?php if($settings->site_offline==0) echo 'selected="selected"'; ?> >No</option>
<label for="site_offline" class="form-control"></label></select></td>
</tr>
<input type="hidden" name="csrf" value="<?=Token::generate();?>" >




</form>
</tbody>
</table>
</div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-1 col-md-offset-1">
    <div class="panel panel-default">
      <form class="" action="admin.php" name="css" method="post">

        <input class='btn btn-large btn-primary' type='submit' name="css" value='Save CSS Settings' class='submit' />
        <!-- Test CSS Settings -->
        <br>
        <strong><h4 align="center">UserSpice CSS Settings</h4></strong>
        <br>
        <label for="us_css1">Primary Color Scheme (Loaded 1st)</label>
        <select class="form-control" name="us_css1">
          <option selected="selected"><?=$settings->us_css1?></option>
          <?php foreach(glob('css/color_schemes/*.css') as $filename){
            // $rest = substr($filename, 7);
            echo "<option value=".$filename.">".$filename."</li>";
          }
          ?>

        </select>

        <br>
        <label for="us_css2">Secondary UserSpice CSS (Loaded 2nd)</label>
        <select class="form-control" name="us_css2">
          <option selected="selected"><?=$settings->us_css2?></option>
          <?php foreach(glob('css/*.css') as $filename){
            // $rest = substr($filename, 7);
            echo "<option value=".$filename.">".$filename."</li>";
          }
          ?>
        </select>

        <br>
        <label for="us_css3">Custom UserSpice CSS (Loaded 3rd)</label>
        <select class="form-control" name="us_css3">
          <option selected="selected"><?=$settings->us_css3?></option>
          <?php foreach(glob('css/*.css') as $filename){
            // $rest = substr($filename, 7);
            echo "<option value=".$filename.">".$filename."</li>";
          }
          ?>
        </select>
        <br>
        <strong><h4 align="center">Front End CSS Settings</h4></strong>
        <br>
        <label for="css1"> Primary Color Scheme (Loaded First)</label>
        <select class="form-control" name="css1">
          <option selected="selected"><?=$settings->css1?></option>

          <?php foreach(glob('css/color_schemes/*.css') as $filename){
            // $rest = substr($filename, 7);
            echo "<option value=".$filename.">".$filename."</li>";
          }
          ?>
  </select>

        <br>
        <label for="css2">Secondary Front End CSS (Loaded 2nd)</label>
        <select class="form-control" name="css2">
            <option selected="selected"><?=$settings->css2?></option>
          <?php foreach(glob('css/*.css') as $filename){
            // $rest = substr($filename, 7);
            echo "<option value=".$filename.">".$filename."</li>";
          }
          ?>

        </select>

        <br>
        <label for="css3">Custom Front End CSS (Loaded 3rd)</label>
        <select class="form-control" name="css3">
          <option selected="selected"><?=$settings->css3?></option>
          <?php foreach(glob('css/*.css') as $filename){
            // $rest = substr($filename, 7);
            echo "<option value=".$filename.">".$filename."</li>";
          }
          ?>

        </select>
      </form>
    </div>

    <!-- footers -->
    <?php require_once("includes/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

    <?php require_once("includes/us_html_footer.php"); // currently just the closing /body and /html ?>

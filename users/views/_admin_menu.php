<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>

  <link rel="stylesheet" href="css/dashboard/normalize.css">
  <link rel="stylesheet" href="css/dashboard/bootstrap.min.css">
  <link rel="stylesheet" href="<?=$us_url_root?>users/fonts/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/dashboard/style.css">

  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
  <script src="js/jquery.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<style>
.btn-circle.btn-lg {
  width: 40px;
  height: 40px;
  padding: 5px 8px;
  font-size: 12px;
  line-height: 1.33;
  border-radius: 25px;
}

.feedback{position: fixed;}

.feedback.left{left:5px; bottom:15px}
.feedback.right{right:5px; bottom:15px}

.feedback .dropdown-menu{width: 290px;height: 250px;bottom: 50px;}
.feedback.left .dropdown-menu{ left: 0px}
.feedback.right .dropdown-menu{ right: 0px}
.feedback .hideme{ display: none}
</style>
</head>
<body>
<?php
//Notifications and messages
  if ($dayLimitQ = $db->query('SELECT notif_daylimit FROM settings', array()))
  $dayLimit = $dayLimitQ->results()[0]->notif_daylimit;
  else
  $dayLimit = 7;

  // 2nd parameter- true/false for all notifications or only current
  $notifications = new Notification($user->data()->id, false, $dayLimit);
  if($settings->messaging == 1){
    $msgQ = $db->query("SELECT id FROM messages WHERE msg_to = ? AND msg_read = 0 AND deleted = 0",array($user->data()->id));
    $msgC = $msgQ->count();
    if($msgC == 1){
      $grammar = 'Message';
    }else{
      $grammar = 'Messages';
    }
  }
?>

<?php

function activeDropdown($View, $dropId, $Area = false){
	$sttngsDown = ['general','reg','social','email'];
	$toolsDown = ['backup','updates','cron','forms','ip','messages','notifications','security_logs','sessions','logs','templates'];
	switch($dropId){
		case 'settings':
		if (in_array($View,$sttngsDown)){
			return ['show', 'true'];
		}
		return ['', 'false'];
		case 'tools':
		if (in_array($View,$toolsDown)){
			return ['show', 'true'];
		}
		return ['', 'false'];
		default:
		return ['','false'];;
	}

}

?>

  <!-- Left Panel -->

  <aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

      <div class="navbar-header">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="<?=$us_url_root?>index.php"><img src="images/logo.png" alt="Logo"></a>
        <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
      </div>

      <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
         <li <?=($view) ? '' : 'class="active"' ;?>>
            <a href="admin.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
          </li>
          <!-- <h3 class="menu-title">Settings</h3> -->
          <?php if(hasPerm([2],$user->data()->id)){?>
          <li class="menu-item-has-children dropdown <?=activeDropdown($view, 'settings')[0];?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="<?=activeDropdown($view, 'settings')[1];?>"> <i class="menu-icon fa fa-gear"></i>Settings</a>
            <ul class="sub-menu children dropdown-menu <?=activeDropdown($view, 'settings')[0];?>">
              <?php if(checkAdminMenu('general')){?> <li <?=($view == 'general') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-gears"></i><a href="admin.php?view=general">General</a></li><?php } ?>
              <?php if(checkAdminMenu('reg')){?> <li <?=($view == 'reg') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-users"></i><a href="admin.php?view=reg">Registration</a></li><?php } ?>
              <?php if(checkAdminMenu('social')){?> <li <?=($view == 'social') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-facebook-square"></i><a href="admin.php?view=social">Social Logins</a></li><?php } ?>
              <?php if(checkAdminMenu('email')){?> <li <?=($view == 'email') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-envelope"></i><a href="admin.php?view=email">Email</a></li><?php } ?>
              <?php if($settings->custom_settings == 1){?> <li <?=($view == 'custom') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-snowflake-o"></i><a href="admin.php?view=custom">Custom Settings</a></li><?php } ?>
                <?php if(in_array($user->data()->id, $master_account)){?> <li <?=($view == 'access') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-file-code-o"></i><a href="admin.php?view=access">Dashboard Access</a></li><?php } ?>
            </ul>
          </li>
        <?php } //end settings menu admin only?>
          <li class="menu-item-has-children dropdown <?=activeDropdown($view, 'tools')[0];?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="<?=activeDropdown($view, 'tools')[1];?>"> <i class="menu-icon fa fa-wrench"></i>Tools</a>
            <ul class="sub-menu children dropdown-menu <?=activeDropdown($view, 'tools')[0];?>">
              <?php if(checkAdminMenu('backup')){?> <li <?=($view == 'backup') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-floppy-o"></i><a href="admin.php?view=backup">Backup</a></li><?php } ?>
              <?php if(checkAdminMenu('updates')){?> <li <?=($view == 'updates') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-arrow-circle-o-up"></i><a href="admin.php?view=updates">Check for Updates</a></li><?php } ?>
              <?php if(checkAdminMenu('cron')){?> <li <?=($view == 'cron') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-terminal"></i><a href="admin.php?view=cron">Cron Jobs</a></li><?php } ?>
              <?php if(checkAdminMenu('forms')){?> <li <?=($view == 'forms') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-pencil"></i><a href="admin.php?view=forms">Form Builder</a></li><?php } ?>
              <?php if(checkAdminMenu('ip')){?> <li <?=($view == 'ip') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-warning"></i><a href="admin.php?view=ip">IP Lists</a></li><?php } ?>
              <?php if(checkAdminMenu('messages')){?> <li <?=($view == 'messages') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-comments"></i><a href="admin.php?view=messages">Messaging System</a></li><?php } ?>
              <?php if(checkAdminMenu('notifications')){?> <li <?=($view == 'notifications') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-bell"></i><a href="admin.php?view=notifications">Notifications</a></li><?php } ?>
              <?php if(checkAdminMenu('security_logs')){?> <li <?=($view == 'security_logs') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-thumbs-down"></i><a href="admin.php?view=security_logs">Security Logs</a></li><?php } ?>
              <?php if(checkAdminMenu('sessions')){?> <li <?=($view == 'sessions') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-magic"></i><a href="admin.php?view=sessions">Sessions</a></li><?php } ?>
              <?php if(checkAdminMenu('logs')){?> <li <?=($view == 'logs') ? 'class="active"' : '' ;?>><i class="menu-icon fa fa-list-ol"></i><a href="admin.php?view=logs">System Logs</a></li><?php } ?>
              <?php if(checkAdminMenu('templates')){?> <li <?=($view == 'templates') ? 'class="active"' : '' ;?>><i class=" menu-icon fa fa-eye"></i><a href="admin.php?view=templates">Templates</a></li><?php } ?>
            </ul>
          </li>
          <?php if(file_exists($abs_us_root.$us_url_root.'usersc/includes/admin_panels.php')){ ?>
            <?php if(checkAdminMenu('stats')){?> <li <?=($view == 'stats') ? 'class="active"' : '' ;?>>
                <a href="admin.php?view=legacy"><i class="menu-icon fa fa-clock-o"></i>Legacy Buttons</a>
            </li>
          <?php } }?>
          <li class="menu-title">Manage</li><!-- /.menu-title -->
            <?php if(checkAdminMenu('nav')){?> <li <?=($view == 'nav') ? 'class="active"' : '' ;?> ><a href="admin.php?view=nav"><i class="menu-icon fa fa-list-alt"></i>Navigation</a></li><?php } ?>
            <?php if(checkAdminMenu('pages')){?> <li <?=($view == 'pages') ? 'class="active"' : '' ;?>><a href="admin.php?view=pages"><i class="menu-icon fa fa-file"></i>Pages</a></li><?php } ?>
            <?php if(checkAdminMenu('permissions')){?> <li <?=($view == 'permissions') ? 'class="active"' : '' ;?>><a href="admin.php?view=permissions"><i class="menu-icon fa fa-lock"></i>Permission Levels</a></li><?php } ?>
            <?php if(checkAdminMenu('plugins')){?> <li <?=($view == 'plugins') ? 'class="active"' : '' ;?>><a href="admin.php?view=plugins"><i class="menu-icon fa fa-plug"></i>Plugins</a></li><?php } ?>
            <?php if(checkAdminMenu('users')){?> <li <?=($view == 'users') ? 'class="active"' : '' ;?>><a href="admin.php?view=users"><i class="menu-icon fa fa-user"></i>Users</a></li><?php } ?>

          <h3 class="menu-title">Misc</h3><!-- /.menu-title -->
          <li class="menu-item">
            <?php if(file_exists($abs_us_root.$us_url_root.'usersc/includes/admin_menu.php')){
              include($abs_us_root.$us_url_root.'usersc/includes/admin_menu.php');
            }?>
            <a href="<?=$us_url_root?>index.php"><i class="menu-icon fa fa-home"></i>Visit Homepage</a>
            <a href="<?=$us_url_root?>users/account.php"><i class="menu-icon fa fa-qq"></i>Your Account</a>
            <a href="<?=$us_url_root?>users/logout.php"><i class="menu-icon fa fa-hand-peace-o"></i>Logout</a>

          </li>

        </ul>
      </div><!-- /.navbar-collapse --><div class="feedback left">
      <div class="tooltips">
          <div class="btn-group dropup">
            <button type="button" class="btn btn-primary dropdown-toggle btn-circle btn-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-bug fa-2x" title="Report Bug"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-right dropdown-menu-form">
              <li>
                <div class="report">
                  <h2 class="text-center">Report Bug</h2>

                    <div class="col-sm-12">
                      <br>Did you find a bug?  Please help the UserSpice team and your fellow developers by reporting it with as much detail as possible.<br><br>
                      </div>
                      <div class="col-sm-12 clearfix">
                      <?php if(hasPerm([2],$user->data()->id)){?>
                       <button class="btn btn-primary btn-block"
                       onclick=" window.open('https://userspice.com/bugs/usersc/dashboard.php','_blank')">Continue</button>
                     <?php } ?>
                     </div>

                </div>
              </li>
            </ul>
          </div>
      </div>
    </div>
    </nav>

  </aside><!-- /#left-panel -->

  <!-- Left Panel -->
<script>
(function ( $ ) {
    $.fn.feedback = function(success, fail) {
    	self=$(this);
		self.find('.dropdown-menu-form').on('click', function(e){e.stopPropagation()})
    	self.find('.do-close').on('click', function(){
			self.find('.dropdown-toggle').dropdown('toggle');
			self.find('.report').show();
		});
	};
}( jQuery ));

$(document).ready(function () {
	// $('.feedback').feedback();
});
</script>
  <!-- Right Panel -->

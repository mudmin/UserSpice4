<?php

if(file_exists("install/index.php")){
	//perform redirect if installer files exist
	//this if{} block may be deleted once installed
	header("Location: install/index.php");
}

require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>

 <div id="page-wrapper">

    <div class="container">

	<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">

        <h1>Welcome to <?php echo $settings->site_name;?></h1>
        <p class="text-muted">An Open Source PHP User Management Framework. <?php //print_r($_SESSION);?></p>
        <p>

		<?php if($user->isLoggedIn())
			{
			$uid = $user->data()->id;
			?>
			<a class="btn btn-default btn-lg" href="users/account.php" role="button">User Account &raquo;</a>
		<?php }
			else
			{
		?>
			<!-- <a class="btn btn-primary btn-lg" href="next.php" role="button">Learn more &raquo;</a> -->
			<a class="btn btn-warning btn-lg" href="users/login.php" role="button">Log In &raquo;</a>
			<a class="btn btn-info btn-lg" href="users/join.php" role="button">Sign Up &raquo;</a>
		<?php } ?>
		</p>

    </div>
      <div class="row">
				<h1>What do I do now?</h1>

							  <!-- CONTENT GOES HERE -->



								<p>Before you get started, there are a few things you need to do.</p>

								<h3  id="step1">Step 1: Change your password!</h3>
								<p>You're going to login with the default username of <strong>admin</strong> and the default password of <strong>password</strong>. You can also login as a standard level user with the credentials of <strong>user</strong> and <strong>password</strong>.  If you cannot login for some reason, edit the login.php file and uncomment out the lines<br> error_reporting(E_ALL);<br>
								  ini_set('display_errors', 1);<br>
								  to see if there are any errors in your server configuration. </p>

								  <h3 >Step 2: Change some settings</h3>
								  <p>You want to go to the Admin Dashboard.From there you can personalize your settings. You can decide whether or not you want to use reCaptcha, force SSL, or mess with some CSS.</p>

								  <h3 >Step 3: Poke around!</h3>
								  <p>From the Admin Dashboard, you can go to Admin Permissions and add some new user levels.  Then check out Admin Pages to decide which pages are private and which are public. Once you make a page private, you can decide how what level of access someone needs to access it.  Any new pages you create in your site folder will automatically show up here.</p>

								 <h3 >Step 4: Check out the other resources</h3>
								  <p>The /blank_pages folder contains a blank version of this page and one with the sidebar included for your convenience. There are also special_blanks that you can drop into your site folder and load up to check out all the things you can do with Bootstrap.</p>

								  <h3 >Step 5: Design and secure your own pages</h3>
								  <p>Of course, using our blanks is the quickest way to get up and running, but you can also secure any page.  Simply add this php code to the top of your page and it will perform a check to see if you've set any special permissions.
									<br>require_once 'users/init.php';<br>
									require_once $abs_us_root.$us_url_root.'users/includes/header.php';<br>
									require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';<br>
									  if (!securePage($_SERVER['PHP_SELF'])){die();}</p>

									  <h3 >Step 6: Check out the forums and documentation at <a target="_blank" href="http://UserSpice.com">UserSpice.com</a></h3>
									  <p>That's where the latest options are and you can find people willing to help!</p>

									  <h3 >Step 7: Replace this ugly homepage with your own beautiful creation</h3>
									  <p>Don't forget to swap out logo.png in the images folder with your own! If you're getting nagging message in the footer, <a href="https://www.google.com/recaptcha/admin#list">go get you some of your own reCAPTCHA keys</a></p>

										<h3 >Step 8: Avoid editing the UserSpice files!!!</h3>
									  <p>But what if you want to change the UserSpice files? We have a solution that lets you edit our files and still not break future upgrades.  For instance, if you want to modify the account.php file... just copy our file into the "usersc" folder.  Then you can edit away and your file will be loaded instead of ours!
										<div class="well well-lg"><p>UserSpice is built using <a href="http://getbootstrap.com/">Twitter's Bootstrap</a>, so it is fully responsive and there is tons of documentation.
													  The look and the feel can be changed very easily. </p>
													  <p>Consider checking out <a href="http://bootsnipp.com">Bootsnipp</a> to see all the widgets and tools you can easily drop into UserSpice to get
													  your project off the ground.</div>
      </div>

    </div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->
	<script type="text/javascript">
	$(document).ready(function(){

	$("#times").load("users/times.php" );

	var timesRefresh = setInterval(function(){
	$("#times").load("users/times.php" );
	}, 30000);

// -------------------------------------------------------------------------
		});
	</script>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

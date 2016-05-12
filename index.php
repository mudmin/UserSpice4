<?php ob_start(); if(!file_exists("core/index.php")){require_once("users/includes/frontend/header.php");
}else{
header("Location: core/index.php");
}

require_once("users/includes/frontend/navigation.php"); ?>

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
			<a class="btn btn-primary btn-lg" href="next.php" role="button">Learn more &raquo;</a>
			<a class="btn btn-warning btn-lg" href="users/login.php" role="button">Log In &raquo;</a>
			<a class="btn btn-info btn-lg" href="users/join.php" role="button">Sign Up &raquo;</a>
		<?php } ?>
		</p>

    </div>


	<div class="large" id="times" ></div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">

		<div class="well">
		<ul>
			<li>User last change password date</li>
			<li>Signup Wizard</li>
		</ul>
		</div>

         <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">

          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
       </div>
        <div class="col-md-4">

          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
      </div>

    </div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once("users/includes/frontend/page_footer.php"); // the final html footer copyright row + the external js calls ?>

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

<?php require_once("users/includes/frontend/html_footer.php"); // currently just the closing /body and /html ?>

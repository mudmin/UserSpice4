<?php
require_once '../../../../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if(isset($user) && $user->isLoggedIn()){
}
?>
<div id="page-wrapper">
	<div class="container">
			<h1 align="center"><?php echo $settings->site_name;?></h1>
    <?php
    echo htmlspecialchars_decode($last->detail);
?>
	</div>
</div>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>

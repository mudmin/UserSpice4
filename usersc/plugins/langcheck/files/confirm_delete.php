<?php
require_once '../../../../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

$last = $db->query("SELECT * FROM us_langcheck ORDER BY id DESC LIMIT 1")->first();
if($last->delete==0){redirect::to('moreinfo.php');}
if(isset($user) && $user->isLoggedIn()){
	if(!empty($_POST)){
		$token = $_POST['csrf'];
		if(!Token::check($token)){
			include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
}
	}
	if(!empty($_POST['deleteHook'])){
		if(!empty($_POST['deny'])){
			Redirect::to('moreinfo.php');
		}
		if(!empty($_POST['confirm'])){
			$userId = $user->data()->id;
			if(!in_array($userId,$master_account)){
				$userdetails = fetchUserDetails(NULL, NULL, $userId); //Fetch user details
				deleteUsers([$userId]);
	        logger($userId,"langcheck","Deleted their account.");
					Redirect::to($us_url_root.'users/logout.php');
			}else{
				Redirect::to('confirm_delete.php?err=You+must+contact+an+admin+to+delete+your+account');
			}
		}
	}
}
$token = Token::generate();
?>
<div id="page-wrapper">
	<div class="container">
			<h1 align="center"><?php echo $settings->site_name;?></h1>
    <?php
    echo htmlspecialchars_decode($last->confirm);
    echo "<br><br>";
?>
<form class="" action="" method="post">
	<input type="hidden" name="csrf" $value=<?=$token;?>" />
	<input type="hidden" name="deleteHook" value="1">
	<input type="submit" name="deny" value="<?=$last->btn_confirm_no?>" class="btn btn-primary">
	<input type="submit" name="confirm" value="<?=$last->btn_confirm_yes?>" class="btn btn-danger">
</form>
	</div>
</div>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>

<?php

require_once 'init.php';
$user = new User();

if(file_exists($abs_us_root.$us_url_root.'usersc/scripts/just_before_logout.php')){
	require_once $abs_us_root.$us_url_root.'usersc/scripts/just_before_logout.php';
}
$user->logout();
if(file_exists($abs_us_root.$us_url_root.'usersc/scripts/just_after_logout.php')){
	require_once $abs_us_root.$us_url_root.'usersc/scripts/just_after_logout.php';
}else{
	//Feel free to change where the user goes after logout!
	if (!$dest = Config::get('homepage_nologin'))
		$dest = 'index.php';
	Redirect::to($dest);
}
?>

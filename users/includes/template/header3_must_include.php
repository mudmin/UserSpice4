<?php
	if ($user->isLoggedIn() && $settings->admin_verify==1) { (!reAuth()); }
	if ($user->isLoggedIn() && isset($_SESSION['twofa']) && $_SESSION['twofa']==1 && $currentPage !== 'twofa.php') Redirect::to($us_url_root.'users/twofa.php');
	require_once $abs_us_root.$us_url_root.'usersc/includes/timepicker.php';


//Plugin hooks
foreach($usplugins as $k=>$v){
  if($v == 1){
  if(file_exists($abs_us_root.$us_url_root."usersc/plugins/".$k."/header.php")){
    include($abs_us_root.$us_url_root."usersc/plugins/".$k."/header.php");
    }
  }
}
	?>

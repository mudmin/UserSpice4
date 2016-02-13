<?php
/*
UserSpice 4
by Dan Hoover at http://UserSpice.com
*/
?>
<?php
if($user->isLoggedIn()){
  Redirect::to('account.php');
}else{
  Redirect::to('login.php');
}
die();
?>

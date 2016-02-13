<?php
/*
UserSpice 43
by Curtis Parham and Dan Hoover at http://UserSpice.com
*/
?>
<?php
require_once("../core/init.php");
if(isset($user) && $user->isLoggedIn()){
  Redirect::to('account.php');
}else{
  Redirect::to('login.php');
}
die();
?>

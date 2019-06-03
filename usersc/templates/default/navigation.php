<?php
require_once($abs_us_root.$us_url_root.'users/includes/navigation.php');
if(isset($_GET['err'])){
  err("<br><br><br><font color='red'>".$err."</font>");
}

if(isset($_GET['msg'])){
  err("<br><br><br><font color='white'>".$msg."</font>");
}
?>

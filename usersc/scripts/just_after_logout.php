<?php
//This is what happens after a user logs out. Where do you want to send them?  What do you want to do?

if (!$dest = Config::get('homepage_nologin')) {
  $dest = 'index.php';
}
Redirect::to($dest);
?>

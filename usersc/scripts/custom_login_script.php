<?php
//Whatever you put here will happen after the username and password are verified and the user is "technically" logged in, but they have not yet been redirected to their starting page.  This gives you access to all the user's data through $user->data()

//Where do you want to redirect the user after login
if (!($dest = Config::get('homepage_login')) &&
    !($dest = Config::get('homepage'))) {
  $dest = 'account.php';
}
Redirect::to($dest);
?>

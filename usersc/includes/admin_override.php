<?php
// This file will let you intercept any of the includes in the admin.php file.

//This is primarily designed to do redirects to your custom page.  If you add a view of the same name in usersc/includes/views
// as the UserSpice view, it will be included instead

//Example

// switch ($view) { //begin switch statement
// case "2fa":
// Redirect::to("https://example.com");
// break;
// case "general":
// Redirect::to($us_url_root.'users/account.');
// break;
// } //end switch statement

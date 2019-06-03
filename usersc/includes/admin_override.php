<?php
// This file will let you intercept any of the includes in the admin.php file.

//This is primarily designed to do redirects to your custom page.  If you add a view of the same name in usersc/includes/views
// as the UserSpice view, it will be included instead


//TO BE CLEAR:  If you want to override an existing view in the admin panel, you can just copy the view to users/includes/admin and your view will be loaded instead of ours.

//This file will allow you to create entirely new view files and put them wherever you want. When you do admin.php?view=completelyrandomname your dashboard will know what to do.
//Example

// switch ($view) { //begin switch statement
// case "completelyrandomname":
// Redirect::to("https://example.com");
// break;
// case "general":
// Redirect::to($us_url_root.'users/account.');
// break;
// } //end switch statement

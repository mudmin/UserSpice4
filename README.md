# UserSpice 4
---
 UserSpice 4 is a complete OOP PDO PHP User Management System.  Full details, documentation, walkthroughs, and forums can be found at UserSpice.com.
 
 
 Ideally the git repository is for tracking changes.  All downloads should probably go through UserSpice.com where they are properly packaged for installtion. 
 
 
 What makes UserSpice different from almost any other PHP User Management Framework is that it has been designed from the beginning to get out of your way so you can spend your time working on your project. Other systems may force you to use their rewriting rules, template engines, frameworks, etc. UserSpice doesn't. You can use as much of it or as little as you choose. It just sits there and does its job.
 
 
 In most cases, UserSpice can control access to your existing pages with a single line of code. From there, we provide an incredible set of PHP Classes and Functions that you can choose to use or not use. Don't like the look? It's built using Bootstrap. You can change the look and feel of your site in seconds with a new css file and some well-documented tweaks.
 
 
 Most importantly, UserSpice is constantly in development. It's constantly getting better and more secure while maintaining the goal of getting out of the way. As additional major features are added, they will be in the form of plugins to keep things modular.
 
 
 So you can get on with the business of designing your project. All while being Bootstrap compatible so you can easily change the look and feel of your project. The goal of UserSpice is to strike a balance of being feature-rich without being bloated

## Version 
* Version 4.1.4b

## Changelog

4.1.4b – (From 4.1.3) – August 29, 2016 – Recommended – Fixes a bunch of bugs found in the forums.   NOTE: To install this patch, unzip the patch over your current install, it will overwrite the following files.

users/admin_users.php

users/email_settings.php (your settings are safe in the database)

users/forgot_password_reset.php

users/user_settings.php (again, your settings are safe)

users/verify.php

users/views/_email_template_forgot_password.php

users/includes/user_spice_ver.php

Many of these patches are documented on our [youtube](https://www.youtube.com/playlist?list=PLixQt02ELp8rjk0kB3FJFcAcJqo8EjIn6) channel.

Bugs Fixed
-User was required to verify email even after resetting password (which requires proof of email).  Forum Discussion here. Credit: user plb

-Verify.php link was wrong – Forum Discussion here.  Credit: user plb.  Video here.

-Bio was not being created when a user was manually created.  Sorry, I can’t find the original post to give credit 🙁

-Email settings not being saved before testing. Credit: user plb.

-User was able to (after verifying once) change their email address to anything.  Forum Discussion here. Credit: user plb.

-User could change username even if it was supposedly disallowed. Forum Discussion here. Credit: users plb and firestorm.  

-Error messages popped up when deleting a user since the manual user creation feature was added. Credit: user firestorm.

PLEASE NOTE: There are a few more usability features coming soon.  I decided to break these bugs out so we could fix errors in this release and add features in the next one.

4.1.3 – (From 4.1.2) – July 24, 2016 – Recommended – Fixes a few random database and usability bugs found in the forums. Gives better (working) guest tracking.  Also allows admins to create new users in the admin_users panel without having to walk through the join process.  NOTE: To install this patch, unzip the patch over your current install, it will overwrite the following files.

users/admin.php

users/admin_users.php

users/helpers/users_online.php

users/helpers/helpers.php

users/helpers/us_helpers.php

users/includes/header.php

users/includes/user_spice_ver.php

IN ADDITION: you also need to run the patchme.php file to make a quick update to your database. It is strongly recommended that you backup your files and your database first.

users/classes/db.php

4.1.2 – (From 4.1.0 and/or 4.1.1) – May 22, 2016 – Recommended – Fixes the initial bugs found on release of version 4.1. Updates the user class, various email functions and some built in helper functions. View 4.1.1 changelog here and the 4.1.2 changelog here.

UserSpice 4.0 Patches
(Current version is located in /users/includes/userspice/user_spice_ver.php)
4.0.0f – Note – If your server is blocking your css files after upgrading to 4.0.0f, the fastest fix is to delete the .htaccess files in all the subfolders.  Sorry about that. The same issue could be going on in the beta as well.  We will release a new version ASAP.

4.0.0e to 4.0.0f – April 11, 2016 – Strongly Recommended – This patch adds .htaccess files to folders that probably should have had them.  Your php files were always safe, but it’s nice to shut down people who are playing around with urls.  Also included in this patch is a the ability to block a user.  Simply go to manage users, click a user’s name, select block and update. They will be presented with a banned message.  It’s something we were toying around with on the UserSpice 4.1 alpha and decided to roll out with the security update. This is an in-place update that adds a lot of .htaccess files and then replaces your existing us_helpers.php file, your admin_user file and your admin_user view.  It shouldn’t break anything.  If you get strange errors of people being banned who shouldn’t be, let us know in the forums, but everything has been tested and seems to work fine.  Best of all…no need to update your database. This structure was baked in all along in the users table as “permissions.”  1 is not blocked, 0 (as in zero permissions) is blocked.

4.0.0d to 4.0.0e – March 28, 2016 – Recommended – These are relatively simple bug fixes in 4.0 that I wanted to get out of the way before beginning on 4.1.  Thanks to everyone in the forums who is pointing this stuff out.  What’s new? I rolled in that fix to the profile system that has been available for about a month into 4.0.0e.  Also fixed were some ugly errors if someone didn’t enter a username or password or if you created a new page but never added it to the database.  Now UserSpice is much more clear about what’s going on.  Also, “remember me” is no longer checked by default on the login form for security reasons.  There are 2 patches.

OR – This one will take you from ANY 4.0 release up to 4.0.0e.

4.0.0 to 4.0.0d – February 22, 2016 – Recommended – Apparently menus are hard. Especially conditional ones.  It’s not a security vulnerability, but administrator links were coming up in regular users’ menus. This patch fixes that.  There will be a completely new navigation overhaul in version 4.1, but this is a temporary solution to the problem. It can be unzipped and will work by dropping it right on top of any version of 4.0 from beta through 4.0.0c.

4.0.0 to 4.0.0c – February 17, 2016 – Recommended – This cumulative patch fixes a bug where the user was given a 404 when trying to reset their password from certain pages.  It also removes the version number from the header and puts it in a separate file. This allows us to change the version number without constantly modifying your header files.   You can install this patch on 4.0.0 or 4.0.0b (formerly referred to as 4.0.1). Because this bug could cause a bad user experience, it is recommended

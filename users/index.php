<?php
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<?php
require_once 'init.php';
if(isset($user) && $user->isLoggedIn()) {
  if (!$dest = Config::get('homepage')) {
    $dest = 'account.php';
  }
} else {
  if (!$dest = Config::get('homepage_nologin')) {
    $dest = 'login.php';
  }
}
Redirect::to($dest);
# If we get here then Redirect::to() failed - perhaps because of a circular redirect
# caused by configuration of homepage=index.php. Inform user and die.
bold('You have an error in your configuration setting your homepage. Either replace this index.php with your own or else set homepage to something besides "index.php" in your users/init.php configuration.');
die();
?>

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
require_once 'includes/user_spice_ver.php';
echo $user_spice_ver ."<br>";
$current_ver = '5.0.0';
echo $current_ver;
$findOut = version_compare($user_spice_ver,  $current_ver);
echo "<br>";

if ($findOut == '-1'){
  echo "Updates are available.";
}

if ($findOut == '0'){
  echo "You are running the latest version.";
}

if ($findOut == '1'){
  echo "Somehow you are running a newer version than we have! You must be from the future!";
}

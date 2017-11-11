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
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();}
if(!empty($_POST)){
	$count = 0;
	$u = $db->query("SELECT id FROM users")->results();
	foreach($u as $me){
		$db->update('users',$me->id,['vericode'=>randomstring(15)]);
		$count++;
	}
	Redirect::to('index.php?err='.$count.'+users+updated!+You+should+delete+vericode.php!');
}
?>

<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<h1 class="page-header">
					UserSpice Vericode Cleanup (Password Reset Fix)
					</h1>
					<h3>This optional tool will make pasword resets more secure.</h3>
				1. It will get rid of any vericodes in your database that were created with a default of 1111.<br>
				2. It will generate the newer, more secure vericodes for all users.<br><br>

				Note: In the (relatively unlikely) event that someone is mid-password reset when you run this, they will have to run the reset again.
				<br><br>
				<form class="" action="vericode.php" method="post">
					<input class="btn btn-success" type="submit" name="submit" value="Make Me Safer!">
				</form>

				<!-- Content Ends Here -->
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</div> <!-- /.wrapper -->


<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

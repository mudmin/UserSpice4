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
<?php require_once '../users/init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>
<?php
if(!in_array($user->data()->id,$master_account)){die();}
if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
//Errors Successes
$errors = [];
$successes = [];
 //Forms posted
if(!empty($_POST)) {

}

?>
<div id="page-wrapper">
	<div class="container-fluid">
		<?php require_once($abs_us_root.$us_url_root.'users/views/_form_manager_menu.php');?>
	<div class="row">
		<div class="col-xs-6">
				<?php require_once($abs_us_root.$us_url_root."users/views/_form_existing_forms.php");?>
		</div>
			<div class="col-xs-6">
				<?php require_once($abs_us_root.$us_url_root."users/views/_form_existing_views.php");?>
			</div>
			</div>
	</div>



	</div>
	<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; ?>

	<script>
	$(document).ready(function() {
	    $('#forms').DataTable({"pageLength": 25,"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]], "aaSorting": []});
			$('#views').DataTable({"pageLength": 25,"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]], "aaSorting": []});
	} );
	</script>
	<script src="../users/js/pagination/jquery.dataTables.js" type="text/javascript"></script>
	<script src="../users/js/pagination/dataTables.js" type="text/javascript"></script>
	<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>

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
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>

<?php
if(!in_array($user->data()->id,$master_account)){die();}
if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
//Errors Successes
$errors = [];
$successes = [];
$demo = Input::get('demo');
$form = Input::get('form');
$formsQ = $db->query("SELECT * FROM us_forms");
$formsC = $formsQ->count();
if($formsC > 0){
	$forms = $formsQ->results();
}

if(!empty($_POST['select_form'])){
	$findPre = Input::get('select_form');
	$findIt = formatName($findPre);

	$findQ = $db->query("SELECT * FROM  $findIt");
	$findC = $findQ->count();
	if($findC > 0){
		$find = $findQ->results();
	}else{
		Redirect::to($us_url_root.'users/admin_form_views.php?err=Form+not+found.');
	}
	$demo = 'z';
}

if(!empty($_POST['create_view'])){
	$vname = Input::get('view_name');
	$vname = preg_replace("/[^A-Za-z0-9]/", "", $vname);
	$selected = Input::get("selected");
	if($selected != ''){
		$selected = json_encode($selected);
		$fields = array(
			'form_name'=>Input::get('select_form'),
			'view_name'=>$vname,
			'fields'=>$selected,
		);
		$db->insert('us_form_views',$fields);
		Redirect::to($us_url_root.'users/admin_form_views.php?err=View+created');
	}else{
		bold("You need to select at least one form field");
	}
}

if(!empty($_POST['delete_view'])){
	$delete = Input::get("delete_view");
	$q = $db->query("SELECT id FROM us_form_views WHERE id = ?",array($delete));
	$c = $q->count();
	if($c > 0){
		$db->query("DELETE FROM us_form_views WHERE id = ?",array($delete));
		Redirect::to($us_url_root.'users/admin_form_views.php?err=View+deleted');
	}
}
?>
<div id="page-wrapper">
	<div class="container-fluid">
			<?php require_once($abs_us_root.$us_url_root.'users/views/_form_manager_menu.php');?>
		<div class="row">
			<div class="col-sm-8">
				<h2>Create a custom form view</h2>
				Custom views allow you to create a simpler version of an existing form.
			</div>
			<div class="col-sm-4">
				<h4>Select a form to create a view</h4>
				<?php if($formsC > 0){ ?>
					<h2><form class="" action="" method="post">
						<select class="" name="select_form">
							<?php foreach($forms as $f) { ?>
								<option value="<?=$f->form?>"><?=$f->form?></option>
							<?php } ?>
						</select>
						<input type="submit" class="btn btn-default" name="submit" value="Go!">
					</form>
				</h2>
			<?php }else{ ?>
				You don't have any forms! <a href="admin_forms.php">Create one </a>first.
			<?php } ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<?php
			if(isset($find)){ //creating new view?>
				<table id="views" class='table table-hover table-list-search'>
					<form class="" action="" method="post">
						<h2>Select the fields you would like to include in your custom view</h2>
						<thead>
							<tr>
								<th>Select</th>
								<th>Field Description</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($find as $f) { ?>
								<tr>
									<td><input type="checkbox" class="form-control" name="selected[]" value="<?=$f->id?>"></td>
									<td><?=$f->form_descrip?></td>
								</tr>
							<?php }
							?>
							<input type="hidden" name="select_form" value="<?=$findPre?>">
						</tbody>
					</table>
					<font size="5"><label for="">Give this view a name</label>
						<input type="text" name="view_name" value="" placeholder="No spaces/special chars" required>
						<input type="submit" name="create_view" value="Create View"></font>
					</form>
					<?php
				} //end create new view
				if(is_numeric($demo)){?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">

					<div class="well">


						<h2>Preview</h2>
						<?php displayView($demo,['nosubmit'=>1]);?>
					</div>
					<?php
				} //end demo
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 well">
				<?php require_once($abs_us_root.$us_url_root."users/views/_form_existing_views.php");?>
			</div> <!-- /.col -->
		</div> <!-- /.row -->

	</div> <!-- /.container -->
</div> <!-- /.wrapper -->


<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

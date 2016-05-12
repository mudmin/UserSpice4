<?php
/*
UserSpice 4
An Open Source PHP User Management System
by Curtis Parham and Dan Hoover at http://UserSpice.com

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
<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
$validation = new Validate();
//PHP Goes Here!

$errors = [];
$successes = [];

//Forms posted
if(!empty($_POST))
{
  $token = $_POST['csrf'];
  if(!Token::check($token)){
    die('Token doesn\'t match!');
  }

  //Delete permission levels
  if(!empty($_POST['delete'])){
    $deletions = $_POST['delete'];
    if ($deletion_count = deletePermission($deletions)){
      $successes[] = lang("PERMISSION_DELETIONS_SUCCESSFUL", array($deletion_count));
    }
  }

  //Create new permission level
  if(!empty($_POST['name'])) {
    $permission = Input::get('name');
    $fields=array('name'=>$permission);
    //NEW Validations
        $validation->check($_POST,array(
          'name' => array(
            'display' => 'Permission Name',
            'required' => true,
            'unique' => 'permissions',
            'min' => 1,
            'max' => 25
          )
        ));
        if($validation->passed()){
          $db->insert('permissions',$fields);
          echo "Permission Updated";

  }else{

    }
  }
}


$permissionData = fetchAllPermissions(); //Retrieve list of all permission levels
$count = 0;
// dump($permissionData);
// echo $permissionData[0]->name;
?>
<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-sm-12">
        <div id="form-errors">
            <?=$validation->display_errors();?></div>
        <!-- Left Column -->
        <div class="class col-sm-3"></div>

        <!-- Main Center Column -->
        <div class="class col-sm-6">
          <!-- Content Goes Here. Class width can be adjusted -->


          <?php include('views/userspice/_admin_permissions.php'); ?>

          <!-- End of main content section -->
        </div>

        <!-- Right Column -->
        <div class="class col-sm-1"></div>
      </div>
    </div>
	</div>
	</div>

    <!-- /.row -->

    <!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->
<script src="js/search.js" charset="utf-8"></script>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

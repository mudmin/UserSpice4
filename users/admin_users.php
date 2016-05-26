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
<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
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
  $deletions = $_POST['delete'];
  if ($deletion_count = deleteUsers($deletions)){
    $successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
  }
  else {
    $errors[] = lang("SQL_ERROR");
  }
}

$userData = fetchAllUsers(); //Fetch information for all users


?>
<div id="page-wrapper">

  <div class="container">

    <!-- Page Heading -->
    <div class="row">

	    <div class="col-xs-12 col-md-6">
		<h1>Manage Users</h1>
	  </div>

	  <div class="col-xs-12 col-md-6">
			<form class="">
				<label for="system-search">Search:</label>
				<div class="input-group">
                    <input class="form-control" id="system-search" name="q" placeholder="Search Users..." type="text">
                    <span class="input-group-btn">
						<button type="submit" class="btn btn-default"><i class="fa fa-times"></i></button>
                    </span>
                </div>
			</form>
		  </div>

        </div>


				 <div class="row">
		     <div class="col-md-12">
          <?php echo resultBlock($errors,$successes);


				?>

							 <hr />
				 <div class="alluinfo">&nbsp;</div>
				<form name="adminUsers" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				 <div class="allutable table-responsive">
					<table class='table table-hover table-list-search'>
					<thead>
					<tr>
						<th>Delete</th><th>Username</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Join Date</th><th>Last Sign In</th><th>Logins</th>
					 </tr>
					</thead>
				 <tbody>
					<?php
					//Cycle through users
					foreach ($userData as $v1) {
							?>
					<tr>
					<td><div class="form-group"><input type="checkbox" name="delete[<?=$v1->id?>]" value="<?=$v1->id?>" /></div></td>
					<td><a href='admin_user.php?id=<?=$v1->id?>'><?=$v1->username?></a></td>
					<td><?=$v1->email?></td>
					<td><?=$v1->fname?></td>
					<td><?=$v1->lname?></td>
					<td><?=$v1->join_date?></td>
					<td><?=$v1->last_login?></td>
					<td><?=$v1->logins?></td>
					</tr>
							<?php } ?>

				  </tbody>
				</table>
				</div>

					<input type="hidden" name="csrf" value="<?=Token::generate();?>" >
				<input class='btn btn-primary' type='submit' name='Submit' value='Delete' /><br><br>
				</form>

		  </div>
		</div>


  </div>
</div>


	<!-- End of main content section -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->
<script src="js/search.js" charset="utf-8"></script>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

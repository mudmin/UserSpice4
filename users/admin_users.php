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
<?php require_once("includes/userspice/us_header.php"); ?>

<?php require_once("includes/userspice/us_navigation.php"); ?>

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
		<h1 >Administrate Users</h1>
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

          include("views/userspice/_admin_users.php");
				?>

		  </div>
		</div>  
		
		
  </div>
</div>

  
	<!-- End of main content section -->
	
    <?php require_once("includes/userspice/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->
<script src="js/search.js" charset="utf-8"></script>

    <?php require_once("includes/userspice/us_html_footer.php"); // currently just the closing /body and /html ?>

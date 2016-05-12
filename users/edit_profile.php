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
?><?php require_once("includes/userspice/us_header.php"); ?>

<?php require_once("includes/userspice/us_navigation.php"); ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
//PHP Goes Here!
$validation = new Validate();
$userID = $user->data()->id;
$grav = get_gravatar(strtolower(trim($user->data()->email)));
$profileQ = $db->query("SELECT * FROM profiles WHERE user_id = ?",array($userID));
$thisProfile = $profileQ->first();
$id = $thisProfile->id;
//Uncomment out the 2 lines below to see what's available to you.
// dump($user);
// dump($thisProfile);

//Forms posted
if(!empty($_POST)) {
    $token = $_POST['csrf'];
    if(!Token::check($token)){
      die('Token doesn\'t match!');
    }else {
      if ($thisProfile->bio != $_POST['bio']){
        $newBio = $_POST['bio'];
        $fields=array('bio'=>$newBio);
        $validation->check($_POST,array(
          'bio' => array(
            'display' => 'Bio',
            'required' => true
          )
        ));
      if($validation->passed()){
        $db->update('profiles',$id,$fields);
        Redirect::to('edit_profile.php');
      }
    }
  }
}
?>
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script>
tinymce.init({
  selector: '#mytextarea'
});
</script>
<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-sm-12">

        <!-- Left Column -->
        <div class="class col-sm-1"></div>

        <!-- Main Center Column -->
        <div class="class col-sm-10">
          <!-- Content Goes Here. Class width can be adjusted -->
          <h1>
            <?=ucfirst($user->data()->username)?>'s Profile
          </h1>
          <img src="<?=$grav; ?>" alt=""class="left-block img-thumbnail" alt="Generic placeholder thumbnail">

          <p><a href="https://en.gravatar.com/">Don't have a profile pic? Get one!</a>

          <h2>Bio</h2>
          <form name="update_bio" action="edit_profile.php" method="post">
            <button type="submit" class="btn btn-primary" name="update_bio">Update Bio</button>
          <textarea id="mytextarea" name="bio"><?=$thisProfile->bio;?></textarea>
          <input type="hidden" name="csrf" value="<?=Token::generate();?>" >
          </form>

          <br><br>
          <!-- End of main content section -->
        </div>

        <!-- Right Column -->
        <div class="class col-sm-1"></div>
      </div>
    </div>

    <!-- /.row -->

    <!-- footers -->
    <?php require_once("includes/userspice/us_page_footer.php"); // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

    <?php require_once("includes/userspice/us_html_footer.php"); // currently just the closing /body and /html ?>

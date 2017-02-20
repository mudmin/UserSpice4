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
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();}
if($settings->messaging != 1){
  Redirect::to('account.php?err=Messaging+is+disabled');
}
?>
<?php
$messagesQ = $db->query("SELECT * FROM message_threads WHERE msg_to = ? OR msg_from = ? ORDER BY id DESC",array($user->data()->id,$user->data()->id));
$messages = $messagesQ->results();

?>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-6">
            <h3>Your messages</h3>
          </div>
          <div class="col-sm-2">
          <a class="btn btn-primary" href="create_message.php">Compose New Message</a>
        </div>
        <!-- Content Goes Here. Class width can be adjusted -->
        <table class="table table-hover">
          <thead>
            <tr>
              <th>From</th>
              <th>To</th>
              <th>Subject</th>
              <th>Last Update</th>
              <th>By</th>
              <th>Unread Count</th>
              <!-- <th>Sent On</th> -->
              <!-- <th>Read</th> -->
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php foreach($messages as $m){ ?>
                <td><a href="message.php?id=<?=$m->id?>"><?php echouser($m->msg_from);?></a></td>
                <td><a href="message.php?id=<?=$m->id?>"><?php echouser($m->msg_to);?></a></td>
                <td><a href="message.php?id=<?=$m->id?>"><?=$m->msg_subject?></a></td>
                <td><a href="message.php?id=<?=$m->id?>"><?=$m->last_update?></a></td>
                <td><a href="message.php?id=<?=$m->id?>"><?php echouser($m->last_update_by);?></a></td>
                <td>
                  <?php
                  $unreadQ = $db->query("SELECT * FROM messages WHERE msg_to = ? AND msg_thread = ? AND msg_read != 1",array($user->data()->id,$m->id));
                  $unread = $unreadQ->count();
                  if($unread > 0){ ?>
                    <font color = "red"><?=$unread?></font>
                    <?php }else{
                      echo "none";
                    }
                    ?>


                  </td>


                </tr>
                <?php } //end foreach	?>
              </tbody>
            </table>
            <!-- End of main content section -->
          </div> <!-- /.col -->
        </div> <!-- /.row -->
      </div> <!-- /.container -->
    </div> <!-- /.wrapper -->


    <!-- footers -->
    <?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->

    <?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

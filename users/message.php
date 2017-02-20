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
<style>
.chat
{
  list-style: none;
  margin: 0;
  padding: 0;
}

.chat li
{
  margin-bottom: 10px;
  padding-bottom: 5px;
  border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
  margin-left: 60px;
}

.chat li.right .chat-body
{
  margin-right: 60px;
}


.chat li .chat-body p
{
  margin: 0;
  color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
  margin-right: 5px;
}

.panel-body
{
  overflow-y: scroll;
  height: 250px;
}

::-webkit-scrollbar-track
{
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  background-color: #F5F5F5;
}

::-webkit-scrollbar
{
  width: 12px;
  background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
  background-color: #555;
}
</style>
<?php
$id = Input::get('id');
$unread = Input::get('unread');


$findThread = $db->query("SELECT * FROM message_threads WHERE id = ?",array($id));
$thread = $findThread->first();

$findMessageQ = $db->query("SELECT * FROM messages WHERE msg_thread = ?",array($id));
$messages = $findMessageQ->results();
$single = $findMessageQ->first();

$findUnread = $db->query("SELECT * FROM messages WHERE msg_thread = ? AND msg_to = ? AND msg_read != 1",array($id, $user->data()->id));
$myUnread = $findUnread->count();

//make sure there are messages TO me in the thread so I don't get a false unread button
$checkToQ = $db->query("SELECT * FROM messages WHERE msg_thread = ? AND msg_to = ?",array($id, $user->data()->id));
$checkTo = $checkToQ->count();


if (($single->msg_to != $user->data()->id) && ($single->msg_from != $user->data()->id)){
  $ip = ipCheck();
  $fields = array(
    'user' 		=> $user->data()->id,
    'page'		=> 42,
    'ip'			=> $ip,
  );
  $db->insert('audit',$fields);
  Redirect::to('messages.php');
}

//ONLY mark messages read if you are the recipient
if($unread != 1){
  foreach ($messages as $message){
    if(($message->msg_read == 0) && ($message->msg_to == $user->data()->id)) {
      $db->update('messages',$message->id,['msg_read'=>1]);
    }
  }
}
//
if(!empty($_POST['markUnread'])){
  // die("<br><br>Unread");
  foreach ($messages as $message){
    if(($message->msg_read == 1) && ($message->msg_to == $user->data()->id)) {
      $db->update('messages',$message->id,['msg_read'=>0]);
      Redirect::to('message.php?id='.$id.'&unread=1');
    }
  }

}

if(!empty($_POST['markRead'])){
  foreach ($messages as $message){
    if(($message->msg_read == 0) && ($message->msg_to == $user->data()->id)) {
      $db->update('messages',$message->id,['msg_read'=>1]);
    }
  }
  Redirect::to('message.php?id='.$id);
}
//
if(!empty($_POST['reply'])){
  $to = $single->msg_to;
  if($to == $user->data()->id){
    $to = $single->msg_from;
  }

  $date = date("Y-m-d H:i:s");
  $fields = array(
    'msg_from'    => $user->data()->id,
    'msg_to'      => $to,
    'msg_body'    => Input::get('msg_body'),
    'msg_thread'  => $id,
    'sent_on'     => $date,
  );

  $db->insert('messages',$fields);

  $threadUpdate = array(
    'last_update'    => $date,
    'last_update_by' => $user->data()->id,
  );

  $db->update('message_threads',$id,$threadUpdate);

  Redirect::to('message.php?id='.$id."&err=Reply+sent!");
}

// $msg = html_entity_decode($message->msg_body);


//PHP Goes Here!
?>
<div id="page-wrapper">
  <div class="container-fluid">

    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="row">
          <div class="col-sm-10">
            <h2><strong>Subject:</strong><?=$thread ->msg_subject?></h2>
          </div>
          <div class="col-sm-2">
            <?php
            if($myUnread == 0 && $checkTo > 0){
              ?>
              <form class="" action="message.php?id=<?php echo $id?>" method="post">
                <input type="submit" class="btn btn-danger" name="markUnread" value="Mark as Unread">
              </form>
              <?php
            }
            ?>
          </div>
        </div>

        <ul class="chat">
          <?php
          //dnd($messages);$grav = get_gravatar(strtolower(trim($user->data()->email)));
          foreach ($messages as $m){
            $findUser = $db->query("SELECT email FROM users WHERE id = $m->msg_from");
            $foundUser = $findUser->first();
            $grav = get_gravatar(strtolower(trim($foundUser->email)));

            if($m->msg_to == $user->data()->id){
              ?>
              <li class="left clearfix"><span class="chat-img pull-left">
                <img src="<?=$grav ?>" width="75" class="img-thumbnail" alt="Generic placeholder thumbnail"></p>
                <!-- <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" /> -->
              </span>
              <div class="chat-body clearfix">
                <div class="header">
                  <strong class="primary-font"><?php echouser($m->msg_from);?></strong> <small class="pull-right text-muted">
                    <span class="glyphicon glyphicon-time"></span><?=$m->sent_on?></small>
                  </div>
                  <p>
                    <?php $msg = html_entity_decode($m->msg_body);
                    echo $msg; ?>
                  </p>
                </div>
              </li>

              <?php }else{ ?>

                <li class="left clearfix"><span class="chat-img pull-left">
                  <img src="<?=$grav; ?>" width="75" class="img-thumbnail" alt="Generic placeholder thumbnail"></p>
                </span>
                <div class="chat-body clearfix">
                  <div class="header">
                    <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span><?=$m->sent_on?></small>
                    <strong class="pull-left primary-font"><?php echouser($m->msg_from);?></strong>
                  </div>
                  <p>
                    <br>
                    <?php $msg = html_entity_decode($m->msg_body);
                    echo $msg; ?>
                  </p>
                </div>
              </li>



              <?php } //end if/else statement ?>


              <?php } //end foreach ?>

              <ul>
                <!-- <h3>From: <?php //echouser($m->msg_from);?></h3> -->

                <h1>Reply</h1>
                <form name="reply_form" action="message.php?id=<?=$id?>" method="post">
                  <input type="submit" class="btn btn-primary" name="reply" value="Reply">
                  <div align="center">
                    <textarea required rows="10" cols="80"  id="mytextarea" name="msg_body" ></textarea></div>
                    <input type="hidden" name="csrf" value="<?=Token::generate();?>" >
                  </p>
                  <p>
                    <input type="submit" class="btn btn-primary" name="reply" value="Reply">
                  </form>
                  <!-- Content Goes Here. Class width can be adjusted -->
                  <!-- End of main content section -->
                </div> <!-- /.col -->
              </div> <!-- /.row -->
            </div> <!-- /.container -->
          </div> <!-- /.wrapper -->


          <!-- footers -->
          <?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>
          <?php if ($settings->wys == 1){  ?>
            <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
            <script>
            tinymce.init({
              selector: '#mytextarea'
            });
            </script>
            <?php } ?>
            <!-- Place any per-page javascript here -->

            <?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

<?php
// This is a user-facing page
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

Special thanks to user Brandin for the mods!
*/
require_once '../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if (!securePage($_SERVER['PHP_SELF'])){die();}
if($settings->messaging != 1){
  Redirect::to($us_url_root.'users/account.php?err=Messaging+is+disabled');
}
$validation = new Validate();
$errors = [];
$successes = [];
?>
<link rel="stylesheet" type="text/css" href="<?=$us_url_root?>users/js/pagination/datatables.min.css" media="screen" />
<?php
if (!empty($_POST)) {
  $token = $_POST['csrf'];
  if(!Token::check($token)){
    include($abs_us_root.$us_url_root.'usersc/scripts/token_error.php');
  }else {
    //Delete User Checkboxes
    if (!empty($_POST['archive'])){
      $deletions = Input::get('archive');
      if ($deletion_count = archiveThreads($deletions,$user->data()->id,1)){
        $successes[] = lang("MSG_ARCHIVE_SUCCESSFUL", array($deletion_count));
        Redirect::to($us_url_root.'users/messages.php');
      }
      else {
        $errors[] = lang("SQL_ERROR");
      }
    }
    if (!empty($_POST['unarchive']) && isset($_POST['checkbox'])){
      $deletions = Input::get('checkbox');
      if ($deletion_count = archiveThreads($deletions,$user->data()->id,0)){
        $successes[] = lang("MSG_UNARCHIVE_SUCCESSFUL", array($deletion_count));
      }
      else {
        $errors[] = lang("SQL_ERROR");
      }
    }
    if (!empty($_POST['delete']) && isset($_POST['checkbox'])){
      $deletions = Input::get('checkbox');
      if ($deletion_count = deleteThread($deletions,$user->data()->id,1)){
        $successes[] = lang("MSG_DELETE_SUCCESSFUL", array($deletion_count));
      }
      else {
        $errors[] = lang("SQL_ERROR");
      }
    }
    if(!empty($_POST['send_message'])){

      if (empty(Input::get('user_id'))) {
        $errors[] = lang("MSG_UNKN"); }

        if (strlen(Input::get('msg_body')) == 0) {
          $errors[] = lang("MSG_BLANK"); }

          $date = date("Y-m-d H:i:s");

          $thread = array(
            'msg_from'    => $user->data()->id,
            'msg_to'      => Input::get('user_id'),
            'msg_subject' => Input::get('msg_subject'),
            'last_update' => $date,
            'last_update_by' => $user->data()->id,
          );
          if (empty($errors)) {
            $db->insert('message_threads',$thread); }
            $newThread = $db->lastId();


            $fields = array(
              'msg_from'    => $user->data()->id,
              'msg_to'      => Input::get('user_id'),
              'msg_body'    => Input::get('msg_body'),
              'msg_thread'  => $newThread,
              'sent_on'     => $date,
            );
            $msgto = Input::get('user_id');
            $msg_subject = Input::get('msg_subject');

            if (empty($errors)) {
              $db->insert('messages',$fields);
              $email = $db->query("SELECT fname,email,msg_notification FROM users WHERE id = ?",array($msgto))->first();
              if($settings->msg_notification == 1 && $email->msg_notification == 1) {
                $params = array(
                  'fname' => $email->fname,
                  'sendfname' => $user->data()->fname,
                  'body' => Input::get('msg_body'),
                  'msg_thread' => $newThread,
                );
                $to = rawurlencode($email->email);
                $body = email_body('_email_msg_template.php',$params);
                email($to,$msg_subject,$body);
                logger($user->data()->id,"Messaging","Sent a message to $email->fname.");
              } }

              $successes[] = lang("MSG_SENT"); }

              if(!empty($_POST['messageSettings'])) {
                //Toggle msg_notification setting
                if($settings->msg_notification==1) {
                  $msg_notification = Input::get("msg_notification");
                  if (isset($msg_notification) AND $msg_notification == 'Yes'){
                    if ($user->data()->msg_notification == 0){
                      if (updateUser('msg_notification', $userId, 1)){
                        $successes[] = lang("FRONTEND_USER_SYS_TOGGLED", array("msg_notification","enabled"));
                      }else{
                        $errors[] = lang("SQL_ERROR");
                      }
                    }
                  }elseif ($user->data()->msg_notification == 1){
                    if (updateUser('msg_notification', $userId, 0)){
                      $successes[] = lang("FRONTEND_USER_SYS_TOGGLED", array("msg_notification","disabled"));
                    }else{
                      $errors[] = lang("SQL_ERROR");
                    }
                  }
                }
              }
            }
          }
          $messagesQ = $db->query("SELECT * FROM message_threads WHERE (msg_to = ? AND archive_to = ? AND hidden_to = ?) OR (msg_from = ? AND archive_from = ? AND hidden_from = ?) ORDER BY last_update DESC",array($user->data()->id,0,0,$user->data()->id,0,0));
          $messages = $messagesQ->results();
          $count = $messagesQ->count();
          $archiveCount = $db->query("SELECT * FROM message_threads WHERE (msg_to = ? AND archive_to = ? AND hidden_to = ?) OR (msg_from = ? AND archive_from = ? AND hidden_from = ?) ORDER BY last_update DESC",array($user->data()->id,1,0,$user->data()->id,1,0))->count();

          $csrf = Token::generate();
          ?>
          <?=resultBlock($errors,$successes);?>
          <?php if(!$validation->errors()=='') {?><div class="alert alert-danger"><?=display_errors($validation->errors());?></div><?php } ?>


          <div class="row">
            <div class="col-sm-12">
              <div>

                <?php if (checkMenu(2,$user->data()->id)){  ?>
                  <div class="btn-group pull-left"><h3><?=lang("MSG_CONV");?> <a href="#" data-toggle="modal" class="nounderline" data-target="#settings"><i class="fa fa-cog"></i></a></h3></div>
                <?php } ?>
                <div class="btn-group pull-right"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#compose"><i class="fa fa-plus"></i> <?=lang("MSG_NEW");?></button>
                </div>
              </center>

            </div>
          </div>
        </div>



        <?php if($count > 0) {?><label><input type="checkbox" class="checkAllMsg" />
          <?=lang("GEN_CHECK");?></label><?php } ?>
          <form name="threads" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <center><table id="paginate" class="table table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php if($count > 0) {?>
                    <?php foreach($messages as $m){
                      if($m->msg_from == $user->data()->id) { $findId = $m->msg_to; } else { $findId = $m->msg_from; }
                      $findUser = $db->query("SELECT picture,email FROM users WHERE id = $findId");
                      if($findUser->count()==1) $foundUser = $findUser->first()->email;
                      if($findUser->count()==0) $foundUser = "null@null.com";
                      $grav = get_gravatar(strtolower(trim($foundUser))); ?>
                      <?php $lastmessage = strtotime($m->last_update);
                      $difference = ceil((time() - $lastmessage) / (60 * 60 * 24));
                      // if($difference==0) { $last_update = "Today, "; $last_update .= date("g:i A",$lastmessage); }
                      if($difference >= 0 && $difference < 7) {
                        $today = date("j");
                        $last_message = date("j",$lastmessage);
                        $msg = lang("GEN_TODAY");
                        if($today==$last_message) { $last_update = $msg.", "; $last_update .= date("g:i A",$lastmessage); }
                        else {
                          $last_update = date("l g:i A",$lastmessage); } }
                          elseif($difference >= 7) { $last_update = date("M j, Y g:i A",$lastmessage); }
                          $replies = $db->query("SELECT COUNT(*) AS count FROM messages WHERE msg_thread = ? GROUP BY msg_thread",array($m->id));
                          $repliescount = $replies->count();
                          ?>
                          <td style="width:100px">
                            <center>
                              <span class="chat-img pull-left" style="padding-right:5px">
                                <a class="nounderline" href="message.php?id=<?=$m->id?>">
                                  <img src="<?=$grav ?>" width="75" class="img-thumbnail">
                                </a>
                              </span>
                            </center>
                          </td>
                          <td class="pull-left">
                            <h4>
                              <input type="checkbox" class="maincheck" name="archive[<?=$m->id?>]" value="<?=$m->id?>"/>
                              <a class="nounderline" href="message.php?id=<?=$m->id?>">
                                <?=$m->msg_subject?> - <?=lang("GEN_WITH");?> <?php if($m->msg_from == $user->data()->id) { echouser($m->msg_to); } else { echouser($m->msg_from); } ?>
                              </a>
                              <?php $unread = $db->query("SELECT * FROM messages WHERE msg_thread = ? AND msg_to = ? AND msg_read = ?",array($m->id,$user->data()->id,0));
                              $unreadCount = $unread->count();?>
                              <?php if($unreadCount > 0) {?> - <font color="red"><?=$unreadCount?> <?=lang("MSG_NEW");?><?php if($unreadCount > 1) {?>s<?php } ?></font><?php } ?></h4>
                              <a class="nounderline" href="message.php?id=<?=$m->id?>">
                                <?=lang("GEN_UPDATED");?> <?=$last_update?> <?=lang("GEN_BY");?> <?php echouser($m->last_update_by);?>
                              </a>
                            </td>
                          </tr>
                        <?php } } else {?>
                          <tr>
                            <td colspan="2"><center><h3><?=lang("MSG_NO_CONV");?></h3></center></td></tr>
                          <?php } ?>
                        </tbody>
                      </table></center>
                      <input type="hidden" name="csrf" value="<?=$csrf?>" />
                      <?php if($count > 0) {?><div class="btn-group pull-right"><input class='btn btn-danger' type='submit' name='Submit' value='<?=lang("MSG_ARC_THR");?>' /></div><?php } ?>
                    </form>
                    <br /><?php if($archiveCount > 0) {?><center><a href="#" data-toggle="modal" data-target="#archived"><?=lang("MSG_VIEW_ARC");?></a></center><?php } ?>
                    <br />




                    <?php
                    include($abs_us_root.$us_url_root."users/views/msg1.php");
                    include($abs_us_root.$us_url_root."users/views/msg2.php");
                    include($abs_us_root.$us_url_root."users/views/msg3.php");
                    include($abs_us_root.$us_url_root."users/views/msg4.php");
                    ?>
                  </div>
                </div> <!-- /.row -->
              </div> <!-- /.container -->
            </div> <!-- /.wrapper -->


            <!-- footers -->
            <?php //require_once $abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'/container_close.php'; //custom template container ?>

            <!-- footers -->
            <?php //require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

            <!-- Place any per-page javascript here -->

            <script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
            <script src="<?=$us_url_root?>users/js/jwerty.js"></script>
            <script src="<?=$us_url_root?>users/js/combobox.js"></script>
            <script>
            $(document).ready(function(){
              $('.combobox').combobox();
            });
            tinymce.init({
              selector: '#mytextarea'
            });
            tinymce.init({
              selector: '#mytextarea2'
            });
            $('.checkAllMsg').on('click', function(e) {
              $('.maincheck').prop('checked', $(e.target).prop('checked'));
            });
            $('.checkAllArchive').on('click', function(e) {
              $('.checkarchive').prop('checked', $(e.target).prop('checked'));
            });
            jwerty.key('esc', function () {
              $('.modal').modal('hide');
            });
            </script>

            <script>
            $(document).ready(function() {
              $('#paginate').DataTable(
                {  searching: false,
                  "stateSave": true,
                  "pageLength": 10
                }
              );
            } );
            </script>
            <!-- <script src="../users/js/pagination/jquery.dataTables.js" type="text/javascript"></script> -->
            <script src="<?=$us_url_root?>users/js/pagination/datatables.min.js" type="text/javascript"></script>

            <?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer

            ?>

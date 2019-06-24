<?php $hooks = getMyHooks(['page' =>'admin.php?view=general']); ?>
<div class="col-sm-8">
  <div class="page-header float-right">
    <div class="page-title">
      <ol class="breadcrumb text-right">
        <li><a href="<?=$us_url_root?>users/admin.php">Dashboard</a></li>
        <li>Settings</li>
        <li class="active">General Settings</li>
      </ol>
    </div>
  </div>
</div>
</div>
</header>

<div class="content mt-3">

  <!-- Site Settings -->
  <form autocomplete="off" class="" action="admin.php?view=<?=$view?>" name="settings" method="post">
    <h2 class="mb-3">Site Settings</h2>
    <div class="row">
      <div class="col-md-6">
        <!-- Left -->
        <div class="card no-padding">
          <div class="card-header"><h3>General Settings</h3></div>
          <div class="card-body">
            <!-- Site Name -->
            <div class="form-group">
              <label for="site_name">Site Name <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Modify this to change the name of your site, including in the <title> tag, the maintenance page and some system emails."><i class="fa fa-question-circle"></i></a></label>
                <input type="text" autocomplete="off" class="form-control ajxtxt" data-desc="Site Name" name="site_name" id="site_name" value="<?=$settings->site_name?>">

              </div>

              <!-- Copyright Option -->
              <div class="form-group">
                <label for="copyright">Copyright Message <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="This message will be at the bottom of every page. The copyright symbol and year are automatically added."><i class="fa fa-question-circle"></i></a></label>
                <input type="text" autocomplete="off" class="form-control ajxtxt" data-desc="Copyright Message" name="copyright" id="copyright" value="<?=$settings->copyright?>">
              </div>

              <!-- Site Offline -->
              <div class="form-group">
                <label for="site_offline">Site Offline <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Need to go into Maintenance Mode to do an upgrade? Enable this! This will display a 'Maintenance Mode Active' message for those in the default Administrator permission group (ID: 2) and redirect the remaining to the maintenance page. This will occur until the setting is disabled.Â Default: No."><i class="fa fa-question-circle"></i></a></label>
                <span style="float:right;">
                  <label class="switch switch-text switch-success">
                    <input id="site_offline" type="checkbox" class="switch-input toggle" data-desc="Site offline" <?php if($settings->site_offline==1) echo 'checked="true"'; ?>>
                    <span data-on="Yes" data-off="No" class="switch-label"></span>
                    <span class="switch-handle"></span>
                  </label>
                </span>
              </div>


              <!-- Track Guests -->
              <div class="form-group">
                <label for="track_guest">Track Guests <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Want details on how many visitors are visiting your site? Keep this on! Site getting laggy, stumbling and having issues? Disable this to see if it fixes it for higher volume sites.Â Default: Yes."><i class="fa fa-question-circle"></i></a></label>
                <span style="float:right;">
                  <label class="switch switch-text switch-success">
                    <input id="track_guest" type="checkbox" class="switch-input toggle" data-desc="Track Guests" <?php if($settings->track_guest==1) echo 'checked="true"'; ?>>
                    <span data-on="Yes" data-off="No" class="switch-label"></span>
                    <span class="switch-handle"></span>
                  </label>
                </span>
              </div>

              <!-- Navigation Type Option -->
              <div class="form-group">
                <label for="navigation_type">Enable Database-Driven Navigation <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="As of U 4.3 navigations can be controlled from the database, switch between the original and database-driven navigaton here. Default: Non-Database Driven."><i class="fa fa-question-circle"></i></a></label>
                <span style="float:right;">
                  <label class="switch switch-text switch-success">
                    <input id="navigation_type" type="checkbox" class="switch-input toggle" data-desc="Navigation style" <?php if($settings->navigation_type==1) echo 'checked="true"'; ?>>
                    <span data-on="Yes" data-off="No" class="switch-label"></span>
                    <span class="switch-handle"></span>
                  </label>
                </span>
              </div>

              <!-- Custom Settings Option -->
              <div class="form-group">
                <label for="custom_settings">Custom Settings Tab <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Enabling this will add a custom settings menu option on the left."><i class="fa fa-question-circle"></i></a></label>
                <span style="float:right;">
                  <label class="switch switch-text switch-success">
                    <input id="custom_settings" type="checkbox" class="switch-input toggle" data-desc="Custom settings tab" <?php if($settings->custom_settings==1) echo 'checked="true"'; ?>>
                    <span data-on="Yes" data-off="No" class="switch-label"></span>
                    <span class="switch-handle"></span>
                  </label>
                </span>
              </div>
            </div>
          </div>

          <div class="card no-padding">
            <div class="card-header"><h3>Security</h3></div>
            <div class="card-body">

              <!-- Force SSL -->
              <div class="form-group">
                <label for="force_ssl">Force HTTPS Connections <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Don't want anyone accessing your site insecurely? Enabled this. This will redirect any users from an HTTP (non-secure) connection to HTTPS. Make sure your SSL Cert is valid before doing this!Â Default: No."><i class="fa fa-question-circle"></i></a></label>
                <span style="float:right;">
                  <label class="switch switch-text switch-success">
                    <input id="force_ssl" type="checkbox" class="switch-input toggle" data-desc="Force HTTPS" <?php if($settings->force_ssl==1) echo 'checked="true"'; ?>>
                    <span data-on="Yes" data-off="No" class="switch-label"></span>
                    <span class="switch-handle"></span>
                  </label>
                </span>
              </div>

              <div class="form-group">
                <label for="twofa">2 Factor Authentication <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Two Factor Auth is here! Default: Disabled.">?</a></label>
                <select id="twofa" class="form-control ajxnum" name="twofa" data-desc="Two Factor Authentication" >
                  <option value="1" <?php if($settings->twofa==1) echo 'selected="selected"'; ?> >Enabled</option>
                  <option value="0" <?php if($settings->twofa==0) echo 'selected="selected"'; ?> >Disabled</option>
                  <option value="-1">Disabled and Reset All Users Two FA</option>
                </select>
              </div>

              <div class="form-group">
                <label for="admin_verify">Require Admin Re-verification <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="In conjunction with ReAuth in the Pages Management section, this setting will require users to reauthenticate themselves using their password or a chosen PIN code based on the time set in the in the timeout setting. Default: Enabled."><i class="fa fa-question-circle"></i></a></label>
                <span style="float:right;">
                  <label class="switch switch-text switch-success">
                    <input id="admin_verify" type="checkbox" class="switch-input toggle" data-desc="Admin Verification" <?php if($settings->admin_verify==1) echo 'checked="true"'; ?>>
                    <span data-on="Yes" data-off="No" class="switch-label"></span>
                    <span class="switch-handle"></span>
                  </label>
                </span>
              </div>

              <div class="form-group">
                <label for="admin_verify_timeout">Admin Verification Timeout <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="The amount of time in Minutes that a user is prompted for Verification as described in the Admin Verification. Minimum:1, Maximum: 999999999. Default: 120 minutes."><i class="fa fa-question-circle"></i></a></label>
                <div class="input-group">
                  <input type="number" step="1" min="1" max="999999999" class="form-control ajxnum" data-desc="Admin Verify Timeout" name="admin_verify_timeout" id="admin_verify_timeout" value="<?=$settings->admin_verify_timeout?>">
                  <span class="input-group-addon">Minutes</span>
                </div>
              </div>

              <div class="form-group">
                <label for="force_user_pr">Force Password Reset <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="This will change the force_pr value in your users database for all users to 1, requiring every user including the current one to reset their password. They will not be able to leave the user settings page until this make this change. This will always be no, however when you change it to Yes and save changes, it will perform the above action, and reset back to no. This isn't a setting, but a function."><i class="fa fa-question-circle"></i></a></label>
                <span style="float:right;">
                  <button type="button" name="force_user_pr" id="force_user_pr" class="btn btn-danger input-group-addon">Force PW Reset</button>
                  <span>
                  </div>

                  <div class="form-group">
                    <label for="permission_restriction">Enable User Permission Restrictions <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Use this as a safeguard to only allow users to add/remove permission levels they have access to. You might use this in a format to give certain users access to add/remove users or make site changes, but you don't want them to give other users permissions they don't have, or take those away. Your safeguard for this (in your own case if you have certain permissions not assigned to yourself) is by restricting the page administration to the default Level 2 as you can do anything from these pages currently. This will still show the user the levels on user administration but will have a disabled attribute.Â Default: Disabled."><i class="fa fa-question-circle"></i></a></label>
                    <span style="float:right;">
                      <label class="switch switch-text switch-success">
                        <input id="permission_restriction" type="checkbox" class="switch-input toggle" data-desc="Password Restriction Setting" <?php if($settings->permission_restriction==1) echo 'checked="true"'; ?>>
                        <span data-on="Yes" data-off="No" class="switch-label"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </span>
                  </div>

                  <div class="form-group">
                    <label for="page_permission_restriction">Enable Page Permission Restrictions <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Only allow one permission level per page using this setting. This is particularly good for ensuring no overlap in permission levels. You can have a permission group hierarchy such as this: User, User Manager, Database Manager, Administrator. In this case you want to give all your User Managers access to the user administration section, and yourself of course, but many not to those who manage your database only (maybe you want to give them access to site and email settings only). In any case, it will change the checkboxes on Admin Page section to radio buttons under Add Permission Level and restrict addition from the permission level settings to be added only if no other level has it.Â Default: Disabled."><i class="fa fa-question-circle"></i></a></label>
                    <span style="float:right;">
                      <label class="switch switch-text switch-success">
                        <input id="page_permission_restriction" type="checkbox" class="switch-input toggle" data-desc="Page Permission Restriction Setting" <?php if($settings->page_permission_restriction==1) echo 'checked="true"'; ?>>
                        <span data-on="Yes" data-off="No" class="switch-label"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </span>
                  </div>

                  <div class="form-group">
                    <label for="page_default_private">New Pages Default To "Private" <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Does what it says. Default: Enabled."><i class="fa fa-question-circle"></i></a></label>
                    <span style="float:right;">
                      <label class="switch switch-text switch-success">
                        <input id="page_default_private" type="checkbox" class="switch-input toggle" data-desc="New Pages Private Setting" <?php if($settings->page_default_private==1) echo 'checked="true"'; ?>>
                        <span data-on="Yes" data-off="No" class="switch-label"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </span>
                  </div>

                  <!-- Cron Job Security -->
                  <a name="cron"></a>
                  <div class="form-group">
                    <label for="cron_ip">Only allow cron jobs from the following IP <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Cron jobs are automated server tasks that can make your life easier.  You may want to make sure, though, that they originate from you and not someone else.  You can whitelist an ip address here."><i class="fa fa-question-circle"></i></a></label>
                    <input type="text" autocomplete="off" class="form-control ajxtxt" data-desc="Cron Job IP" name="cron_ip" id="cron_ip" value="<?=$settings->cron_ip?>" placeholder="<?php if($settings->cron_ip == ''){echo 'No security is IP is set';}?>">
                  </div>



                  <div class="form-group">
                    <label for="session_manager">Enable Session Management <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Session Management will track unique details about users including their unique fingerprint, IP, OS, Browser, Session Start Time, End Time and their last activity and page. Session Management can allow forceful and soft ending of sessions including a kill switch via the Admin Panel to log all users out. Default: Enabled."><i class="fa fa-question-circle"></i></a></label>
                    <span style="float:right;">
                      <label class="switch switch-text switch-success">
                        <input id="session_manager" type="checkbox" class="switch-input toggle" data-desc="Session Management Setting" <?php if($settings->session_manager==1) echo 'checked="true"'; ?>>
                        <span data-on="Yes" data-off="No" class="switch-label"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </span>
                  </div>
                </div>
              </div>
              <?php includeHook($hooks,'body');?>
            </div>

            <!-- right column -->
            <div class="col-md-6">
              <!-- Force Password Reset -->
              <div class="card no-padding">
                <div class="card-header"><h3>Messages & Notifications</h3></div>
                <div class="card-body">

                  <!-- Messaging Option -->
                  <div class="form-group">
                    <label for="messaging">Enable Messaging System<a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Enable or disable the built in messaging system which features Mass Messaging, user-specific messaging with replies in thread format and email notifications.Â Default: Disabled."><i class="fa fa-question-circle"></i></a></label>
                    <span style="float:right;">
                      <label class="switch switch-text switch-success">
                        <input id="messaging" type="checkbox" class="switch-input toggle" data-desc="Messaging System Status" <?php if($settings->messaging==1) echo 'checked="true"'; ?>>
                        <span data-on="Yes" data-off="No" class="switch-label"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </span>
                  </div>

                  <!-- WYSIWYG Option -->
                  <div class="form-group">
                    <label for="wys">Enable WYSIWYG Editor <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="This does what it says. If you want to disable the Editor, you can change this. This is used in the messaging system.Â Default: Enabled."><i class="fa fa-question-circle"></i></a></label>
                    <span style="float:right;">
                      <label class="switch switch-text switch-success">
                        <input id="wys" type="checkbox" class="switch-input toggle" data-desc="WYSIWYG Editor Status" <?php if($settings->wys==1) echo 'checked="true"'; ?>>
                        <span data-on="Yes" data-off="No" class="switch-label"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </span>
                  </div>

                  <!-- Notification System -->
                  <div class="form-group">
                    <label for="notifications">Enable Notification System <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Enable or disable the notification system. Default: Disabled."><i class="fa fa-question-circle"></i></a></label>
                    <span style="float:right;">
                      <label class="switch switch-text switch-success">
                        <input id="notifications" type="checkbox" class="switch-input toggle" data-desc="Notification System Status" <?php if($settings->notifications==1) echo 'checked="true"'; ?>>
                        <span data-on="Yes" data-off="No" class="switch-label"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </span>
                  </div>

                  <!-- Notification System -->
                  <div class="form-group">
                    <label for="force_notif">Force users to see notifications <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="With this enabled, notifications will popup automatically for your users. It could be annoying, but in some situatuons, notifications are crucial."><i class="fa fa-question-circle"></i></a></label>
                    <span style="float:right;">
                      <label class="switch switch-text switch-success">
                        <input id="force_notif" type="checkbox" class="switch-input toggle" data-desc="Force Notifications Setting" <?php if($settings->force_notif==1) echo 'checked="true"'; ?>>
                        <span data-on="Yes" data-off="No" class="switch-label"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </span>
                  </div>

                  <!-- Expiration for Notifications Setting -->
                  <div class="form-group">
                    <label for="notif_daylimit">Expiration for Notifications <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Notifications are archived from user views automatically when they load a page that has the HTML footer (by default all US files) based on the date of the notification, and the difference between that date and now. Change this to increase or decrease the amount of days. Minimum: 1, Maximum: 999, Default: 7."><i class="fa fa-question-circle"></i></a></label>
                    <div class="input-group">
                      <input type="number" step="1" min="1" max="999" class="form-control ajxnum" data-desc="Expiration For Notifications" name="notif_daylimit" id="notif_daylimit" value="<?=$settings->notif_daylimit?>">
                      <span class="input-group-addon">Days</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card no-padding">
                <div class="card-header"><h3>User Settings</h3></div>
                <div class="card-body">

                  <!-- Force Password Reset -->
                  <div class="form-group">
                    <label for="force_pr">Force Password Reset on Manual Creation <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="When a user is created from the admin panel, force their password to be reset upon login, this will also send them a password reset link on manual creation no matter what password you enter on the form. If you enable this, theÂ force_pr value in your users database for this user will be 1 when created.Â Default: No."><i class="fa fa-question-circle"></i></a></label>
                    <span style="float:right;">
                      <label class="switch switch-text switch-success">
                        <input id="force_pr" type="checkbox" class="switch-input toggle" data-desc="Force Inital Password Reset" <?php if($settings->force_pr==1) echo 'checked="true"'; ?>>
                        <span data-on="Yes" data-off="No" class="switch-label"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </span>
                  </div>

                  <div class="form-group">
                    <label for="redirect_uri_after_login">Redirect After Login <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="The folder and file that you wish to redirect the user to after login. Default: users/account.php. Note that admins get redirected to this dashboard by default unless you intercept that call with something in usersc/scripts/custom_login_script.php"><i class="fa fa-question-circle"></i></a></label>
                    <input type="text" autocomplete="off" class="form-control ajxtxt" data-desc="Redirect After Login" name="redirect_uri_after_login" id="redirect_uri_after_login" value="<?=$settings->redirect_uri_after_login?>">
                  </div>

                  <!-- echouser Option -->
                  <div class="form-group">
                    <label for="echouser">echouser Function <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="What do you want to echo when you use theÂ echouser function? You can use this to echo their name in several different formats. Need their username instead? UseÂ echousername. If it cannot find the user, it will echo Deleted.Â Default: FName LName."><i class="fa fa-question-circle"></i></a></label>
                    <select id="echouser" class="form-control ajxnum" data-desc="echouser Function" name="echouser">
                      <option value="0" <?php if($settings->echouser==0) echo 'selected="selected"'; ?> >FName LName</option>
                      <option value="1" <?php if($settings->echouser==1) echo 'selected="selected"'; ?> >Username</option>
                      <option value="2" <?php if($settings->echouser==2) echo 'selected="selected"'; ?> >Username (FName LName)</option>
                      <option value="3" <?php if($settings->echouser==3) echo 'selected="selected"'; ?> >Username (FName)</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="card no-padding">
                <div class="card-header"><h3>Invisible Recaptcha</h3></div>
                <div class="card-body">
                  <!-- Recaptcha Option -->
                  <div class="form-group">
                    <label for="recaptcha">Invisible Recaptcha <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Use the Google Recaptcha to protect yourself from spam registrations and logins, and to verify the legitimacy of a users session. You can set this to Enabled for Registration and Logins, or just Registrations.Â Default: Disabled."><i class="fa fa-question-circle"></i></a></label>
                    <select id="recaptcha" class="form-control ajxnum" data-desc="Invisible Recaptcha" name="recaptcha">
                      <option value="1" <?php if($settings->recaptcha==1) echo 'selected="selected"'; ?> >Enabled</option>
                      <option value="0" <?php if($settings->recaptcha==0) echo 'selected="selected"'; ?> >Disabled</option>
                      <option value="2" <?php if($settings->recaptcha==2) echo 'selected="selected"'; ?> >For Join Only</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="min_pw">Invisible Recaptcha Public (Site) Key</label> <?php if(in_array($user->data()->id, $master_account)) {?><a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" id="recapatcha_public_show"><span class="fa fa-eye"></span> show</a><?php } ?>
                    <input type="password" autocomplete="off" class="form-control ajxtxt" data-desc="Recaptcha Site Key" name="recap_public" id="recap_public" value="<?=$settings->recap_public?>">
                  </div>

                  <div class="form-group">
                    <label for="max_pw">Invisible Recaptcha Private (Secret) Key</label> <?php if(in_array($user->data()->id, $master_account)) {?><a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" id="recapatcha_private_show"><span class="fa fa-eye"></span> show</a><?php } ?>
                    <input type="password" autocomplete="off" class="form-control ajxtxt" data-desc="Recaptcha Private Key" name="recap_private" id="recap_private" value="<?=$settings->recap_private?>">
                  </div>
                </div>
              </div>


              <div class="card no-padding">
                <div class="card-header"><h3>Language</h3>
                    There may be more langauges available <a href="https://userspice.com/translations"><font color="blue">here</font></a>.<br>
                </div>
                <div class="card-body">

                  <!-- Set Default Language -->
                  <?php $languages = scandir($abs_us_root.$us_url_root."users/lang");
                  foreach($languages as $k=>$v){
                    $languages[$k] = substr($v,0,-4);
                  }
                  ?>
                  <div class="form-group">

                    <label for="default_language">Default Language <a href="#!" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="Set the default language for your site"><i class="fa fa-question-circle"></i></a></label>
                    <select id="default_language" class="form-control ajxtxt" data-desc="Default Language" name="default_language">
                      <option value="<?=$settings->default_language?>"><?=$settings->default_language?></option>
                      <?php foreach ($languages as $l) {
                        if($l != false && $l !=$settings->default_language){?>
                          <option value="<?=$l?>"><?=$l?></option>
                        <?php }
                      }?>
                    </select>
                  </div>

                  <!-- Allow Users To Change Language -->
                  <div class="form-group">
                    <label for="allow_language">Allow users to change their language <a href="#!" role="button" tabindex="-1" title="Note" data-trigger="focus" class="nounderline" data-toggle="popover" data-content="With this enabled, logged in users will be able to set their default language and non-logged in users will be able to change their language for this session."><i class="fa fa-question-circle"></i></a></label>
                    <span style="float:right;">
                      <label class="switch switch-text switch-success">
                        <input id="allow_language" type="checkbox" class="switch-input toggle" data-desc="Allow user to change language setting" <?php if($settings->allow_language==1) echo 'checked="true"'; ?>>
                        <span data-on="Yes" data-off="No" class="switch-label"></span>
                        <span class="switch-handle"></span>
                      </label>
                    </span>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <input type="hidden" name="csrf" value="<?=Token::generate()?>" />
        </form>
        <?php if(in_array($user->data()->id, $master_account)) {?>
          <script type="text/javascript">
          $(document).ready(function(){


            $('#recapatcha_public_show').hover(function () {
              $('#recap_public').attr('type', 'text');
            }, function () {
              $('#recap_public').attr('type', 'password');
            });
            $('#recapatcha_private_show').hover(function () {
              $('#recap_private').attr('type', 'text');
            }, function () {
              $('#recap_private').attr('type', 'password');
            });
          });
        </script>
      <?php } ?>

<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-1 col-md-offset-1">
    <div class="panel panel-default" >
    <button class='btn btn-primary' href="#">Current Site Stats</button>
    <form class="">
      <?php  if($settings->track_guest == 1){ ?>
      <div class="" align="center"><strong ><h4 >All Visitors</h4>(Whether logged in or not) </strong></div>
      <?php
      if (count_users() == 1) {
          echo "   In the last 30 minutes, there was " . count_users() . " unique visitor online.<br>";
      }
      else {
          echo "In the last 30 minutes, there were " . count_users() . " unique visitors online.<br>";
      }
    }
      ?>
            <div class="" align="center"><strong ><h4 >All Users</h4>(Who have logged in) </strong></div>
<?=$hourCount?> of your users have logged in over the past hour.<br>
<?=$dayCount?> of your users have logged in over the past day.<br>
<?=$weekCount?> of your users have logged in over the past week.<br>
<?=$monthCount?> of your users have logged in over the past month.<br><br>
The following users have logged in over the past 24 hours...
<?php

foreach($usersDay as $v1){
  ?>
  <li><a href="admin_user.php?id=<?=$v1->id?>"><?=ucfirst($v1->username)?></a></li>
<?php } ?>

    </form>
    </div>
  </div>
  <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-1 col-md-offset-1">
    <div class="panel panel-default">
      <!-- Default panel contents -->
      <form class="" action="admin.php" name="settings" method="post">

        <input class='btn btn-primary' type='submit' name="settings" value='Update Settings' class='submit' />

        <div class="" align="center"><strong ><h4 >UserSpice Settings</h4></strong></div>

        <!-- List group -->
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Option</th>
              <th>Setting</th>
            </tr>
          </thead>
          <tbody>

            <!-- Site Name -->
            <tr>
              <td><label for="site_name">Site Name</label></td>
              <td>
                <input type="text" class="form-control" name="site_name" id="site_name" value="<?=$settings->site_name?>">
              </td>
            </tr>
            <!-- Recaptcha Option -->
            <tr>
              <td><label for="recaptcha">Recaptcha</label></td>
              <td><select id="recaptcha" class="form-control" name="recaptcha">
                <option value="1" <?php if($settings->recaptcha==1) echo 'selected="selected"'; ?> >Enabled</option>
                <option value="0" <?php if($settings->recaptcha==0) echo 'selected="selected"'; ?> >Disabled</option>
                <label for="recaptcha" class="form-control"></label></select></td>
              </tr>

              <!-- Login Via Username or Email -->
              <!-- <tr>
                <td><label for="login_type">Login Using (disabled)</label></td>
                <td><select id="login_type" class="form-control" name="login_type">
                  <option value="email" <?php if($settings->login_type=='email') echo 'selected="selected"'; ?> >Email</option>
                  <option value="username" <?php if($settings->login_type=='username') echo 'selected="selected"'; ?> >Username</option>
                  <label for="login_type" class="form-control"></label></select></td>
                </tr> -->

                <!-- Force SSL -->
                <tr>
                  <td><label for="force_ssl">Force SSL (experimental)</label></td>
                  <td><select id="force_ssl" class="form-control" name="force_ssl">
                    <option value="1" <?php if($settings->force_ssl==1) echo 'selected="selected"'; ?> >Yes</option>
                    <option value="0" <?php if($settings->force_ssl==0) echo 'selected="selected"'; ?> >No</option>
                    <label for="force_ssl" class="form-control"></label></select></td>
                  </tr>

                  <!-- Force Password Reset -->
                  <!-- <tr>
                    <td><label for="force_pr">Force Password Reset (disabled)</label></td>
                    <td><select id="force_pr" class="form-control" name="force_pr">
                      <option value="1" <?php if($settings->force_pr==1) echo 'selected="selected"'; ?> >Yes</option>
                      <option value="0" <?php if($settings->force_pr==0) echo 'selected="selected"'; ?> >No</option>
                      <label for="force_pr" class="form-control"></label></select></td>
                    </tr> -->

                    <!-- Site Offline -->
                    <tr>
                      <td><label for="site_offline">Site Offline</label></td>
                      <td><select id="site_offline" class="form-control" name="site_offline">
                        <option value="1" <?php if($settings->site_offline==1) echo 'selected="selected"'; ?> >Yes</option>
                        <option value="0" <?php if($settings->site_offline==0) echo 'selected="selected"'; ?> >No</option>
                        <label for="site_offline" class="form-control"></label></select></td>
                      </tr>
                      <!-- Track Guests -->
                      <tr>
                        <td><label for="track_guest">Track Guests</label></td>
                        <td><select id="track_guest" class="form-control" name="track_guest">
                          <option value="1" <?php if($settings->track_guest==1) echo 'selected="selected"'; ?> >Yes</option>
                          <option value="0" <?php if($settings->track_guest==0) echo 'selected="selected"'; ?> >No</option>
                          <label for="track_guest" class="form-control"></label></select>If your site gets a lot of traffic and starts to stumble, this is the first thing to turn off.</td>

                        </tr>
                      <input type="hidden" name="csrf" value="<?=Token::generate();?>" >




                    </form>
                  </tbody>
                </table>
              </div>
            </div>
            </div>

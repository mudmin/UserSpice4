<div class="col-sm-8">
  <div class="page-header float-right">
    <div class="page-title">
      <ol class="breadcrumb text-right">
        <li><a href="<?=$us_url_root?>users/admin.php">Dashboard</a></li>
        <li>Settings</li>
        <li class="active">Registration Settings</li>
      </ol>
    </div>
  </div>
</div>
</div>
</header>
<div class="content mt-3">
  <form class="" action="admin.php?tab=3" name="register" method="post">
    <h2>Registration Settings</h2><br>
    <div class="row">
      <div class="col-sm-6">

        <div class="form-group">
          <label for="registration">Allow New User Registration <a class="nounderline" data-toggle="tooltip" title="Registration Switcher! Also controls OAuth (Social Logins). Default: Enabled.">?</a></label>
          <span style="float:right;">
            <label class="switch switch-text switch-success">
              <input id="registration" type="checkbox" class="switch-input toggle" data-desc="Registration System" <?php if($settings->registration==1) echo 'checked="true"'; ?>>
              <span data-on="Yes" data-off="No" class="switch-label"></span>
              <span class="switch-handle"></span>
            </label>
          </span>
        </div>

        <div class="form-group">
          <label for="join_vericode_expiry">Registration Vericode Expiry (in hours) <a class="nounderline" data-toggle="tooltip" title="Length of time in hours for expiration of vericodes to email. Maximum: 999999999 (thats nine 9s!). Default: 24">?</a></label>
          <div class="input-group">
            <input type="number" step="1" min="1" max="999999999" class="form-control ajxnum" data-desc="Registration Vericode Expiry" name="join_vericode_expiry" id="join_vericode_expiry" value="<?=$settings->join_vericode_expiry?>">
            <span class="input-group-addon">Hours</span>
          </div>
        </div>

        <!-- Allow users to change Usernames -->
        <div class="form-group">
          <label for="change_un">Allow users to change their Usernames <a class="nounderline" data-toggle="tooltip" title="Does as it says. Default: Disabled.">?</a></label>
          <select id="change_un" class="form-control ajxnum" data-desc="Allow users to change their Usernames" name="change_un">
            <option value="0" <?php if($settings->change_un==0) echo 'selected="selected"'; ?> >Disabled</option>
            <option value="1" <?php if($settings->change_un==1) echo 'selected="selected"'; ?> >Enabled</option>
            <option value="2" <?php if($settings->change_un==2) echo 'selected="selected"'; ?> >Only once</option>
          </select>
        </div>

        <div class="form-group">
          <label for="auto_assign_un">Auto Assign Usernames <a class="nounderline" data-toggle="tooltip" title="Don't want users to choose their usernames? No worries! Enable this and a users default username will be their first initial and last name. This already exists? Okay! Lets do first name and last initial. Still not good? Email address it is since you won't be duplicating emails in your database! This will remove the username field from both the external and internal registration forms. Default: Disabled.">?</a></label>
          <select id="auto_assign_un" class="form-control ajxnum" data-desc="Auto Assign Usernames" name="auto_assign_un">
            <option value="1" <?php if($settings->auto_assign_un==1) echo 'selected="selected"'; ?> >Enabled</option>
            <option value="0" <?php if($settings->auto_assign_un==0) echo 'selected="selected"'; ?> >Disabled</option>
          </select>
        </div>

        <div class="form-group">
          <label for="min_pw">Minimum Password Length</label>
          <input type="number" step="1" min="4" max="150" class="form-control ajxnum" data-desc="Minimum Password Length" name="min_pw" id="min_pw" value="<?=$settings->min_pw?>">
        </div>
        <div class="form-group">
          <label for="max_pw">Maximum Password Length</label>
          <input type="number" step="1" min="4" max="150" class="form-control ajxnum" data-desc="Maximum Password Length" name="max_pw" id="max_pw" value="<?=$settings->max_pw?>">
        </div>
        <div class="form-group">
          <label for="show_tos">Show Terms of Service/User Agreement</label>
          <span style="float:right;">
            <label class="switch switch-text switch-success">
              <input id="show_tos" type="checkbox" class="switch-input toggle" data-desc="Terms of Service Requirement" <?php if($settings->show_tos==1) echo 'checked="true"'; ?>>
              <span data-on="Yes" data-off="No" class="switch-label"></span>
              <span class="switch-handle"></span>
            </label>
          </span><br>
          Note: Enabling this from disabled will require oauth users to reacknowledge TOS.


        </div>

      </div>

      <div class="col-sm-6">
        <!-- right -->

        <div class="form-group">
          <label for="reset_vericode_expiry">Password Reset Vericode Expiry (in minutes) <a class="nounderline" data-toggle="tooltip" title="Length of time in minutes for expiration of password reset vericodes to email. Maximum: 999999999 (thats nine 9s!). Default: 15">?</a></label>
          <div class="input-group">
            <input type="number" step="1" min="1" max="999999999" class="form-control ajxnum" data-desc="Password Reset Vericode Expiry" name="reset_vericode_expiry" id="reset_vericode_expiry" value="<?=$settings->reset_vericode_expiry?>">
            <span class="input-group-addon">Minutes</span>
          </div>
        </div>

        <div class="form-group">
          <label for="req_num">Recommend a Number in the Password?</label>
          <span style="float:right;">
            <label class="switch switch-text switch-success">
              <input id="req_num" type="checkbox" class="switch-input toggle" data-desc="Recommend a Number" <?php if($settings->req_num==1) echo 'checked="true"'; ?>>
              <span data-on="Yes" data-off="No" class="switch-label"></span>
              <span class="switch-handle"></span>
            </label>
          </span>
        </div>
        <div class="form-group">
          <label for="req_cap">Recommend a Capital Letter in the Password?</label>
          <span style="float:right;">
            <label class="switch switch-text switch-success">
              <input id="req_cap" type="checkbox" class="switch-input toggle" data-desc="Recommend a Capital Letter" <?php if($settings->req_cap==1) echo 'checked="true"'; ?>>
              <span data-on="Yes" data-off="No" class="switch-label"></span>
              <span class="switch-handle"></span>
            </label>
          </span>
        </div>
        <div class="form-group">
          <label for="min_un">Minimum Username Length</label>
          <div class="input-group">
            <input type="number" step="1" min="1" max="255" class="form-control ajxnum" data-desc="Minimum Username Length" name="min_un" id="min_un" value="<?=$settings->min_un?>">
            <span class="input-group-addon">characters</span>
          </div>
        </div>
        <div class="form-group">
          <label for="max_un">Maximum Username Length</label>
          <div class="input-group">
            <input type="number" step="1" min="1" max="255" class="form-control ajxnum" data-desc="Maximum Username Length" name="max_un" id="max_un" value="<?=$settings->max_un?>">
            <span class="input-group-addon">characters</span>
          </div>
        </div>

      </div>


    </div>

    <input type="hidden" name="csrf" value="<?=Token::generate()?>" />

  </form>
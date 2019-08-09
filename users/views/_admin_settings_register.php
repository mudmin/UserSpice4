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
  <form autocomplete="off" class="" action="admin.php?tab=3" name="register" method="post">
    <h2 class="mb-3">Registration Settings</h2>
    <div class="row">
      <div class="col-md-6">


        <div class="card no-padding">
          <div class="card-body">

            <div class="form-group">
              <label for="registration">Allow New User Registration <a href="#!" class="nounderline" data-toggle="popover" data-content="Registration Switcher! Also controls OAuth (Social Logins). Default: Enabled." title="Note"><i class="fa fa-question-circle"></i></a></label>
              <span style="float:right;">
                <label class="switch switch-text switch-success">
                  <input id="registration" type="checkbox" class="switch-input toggle" data-desc="Registration System" <?php if($settings->registration==1) echo 'checked="true"'; ?>>
                  <span data-on="Yes" data-off="No" class="switch-label"></span>
                  <span class="switch-handle"></span>
                </label>
              </span>
            </div>

            <div class="form-group">
              <label for="show_tos">Show Terms of Service/User Agreement <a href="#!" data-toggle="popover" class="nounderline" title="Note" data-content="Enabling this from disabled will require oauth users to reacknowledge TOS" ><i class="fa fa-question-circle"></i></a></label>
              <span style="float:right;">
                <label class="switch switch-text switch-success">
                  <input id="show_tos" type="checkbox" class="switch-input toggle" data-desc="Terms of Service Requirement" <?php if($settings->show_tos==1) echo 'checked="true"'; ?>>
                  <span data-on="Yes" data-off="No" class="switch-label"></span>
                  <span class="switch-handle"></span>
                </label>
              </span>
            </div>

            <div class="form-group">
              <label for="join_vericode_expiry">Registration Vericode Expiry (in hours) <a href="#!" class="nounderline" data-toggle="popover" title="Note" data-content="Length of time in hours for expiration of vericodes to email. Maximum: 999999999 (thats nine 9s!). Default: 24"><i class="fa fa-question-circle"></i></a></label>
              <div class="input-group">
                <input type="number" step="1" min="1" max="999999999" class="form-control ajxnum" data-desc="Registration Vericode Expiry" name="join_vericode_expiry" id="join_vericode_expiry" value="<?=$settings->join_vericode_expiry?>">
                <span class="input-group-addon">Hours</span>
              </div>
            </div>

            <!-- Allow users to change Usernames -->
            <div class="form-group">
              <label for="change_un">Allow users to change their Usernames <a href="#!" class="nounderline" title="Note" data-toggle="popover" data-content="Does as it says. Default: Disabled."><i class="fa fa-question-circle"></i></a></label>
              <select id="change_un" class="form-control ajxnum" data-desc="Allow users to change their Usernames" name="change_un">
                <option value="0" <?php if($settings->change_un==0) echo 'selected="selected"'; ?> >Disabled</option>
                <option value="1" <?php if($settings->change_un==1) echo 'selected="selected"'; ?> >Enabled</option>
                <option value="2" <?php if($settings->change_un==2) echo 'selected="selected"'; ?> >Only once</option>
              </select>
            </div>

            <div class="form-group">
              <label for="auto_assign_un">Auto Assign Usernames <a href="#!" class="nounderline" title="Note" data-toggle="popover" data-content="Don't want users to choose their usernames? No worries! Enable this and a users default username will be their first initial and last name. This already exists? Okay! Lets do first name and last initial. Still not good? Email address it is since you won't be duplicating emails in your database! This will remove the username field from both the external and internal registration forms.Â Default: Disabled."><i class="fa fa-question-circle"></i></a></label>
              <select id="auto_assign_un" class="form-control ajxnum" data-desc="Auto Assign Usernames" name="auto_assign_un">
                <option value="1" <?php if($settings->auto_assign_un==1) echo 'selected="selected"'; ?> >Enabled</option>
                <option value="0" <?php if($settings->auto_assign_un==0) echo 'selected="selected"'; ?> >Disabled</option>
              </select>
            </div>

            <div class="form-group">
                <label for="reg_restriction_maildomain">Restrict registration to selected domains <a href="#!" class="nounderline" title="Note" data-toggle="popover" data-content="Want to restrict registration to selected email domains? If you want to allow more than one domain, seperate them by semicolon. For example: userspice.com;example.com;php.net"><i class="fa fa-question-circle"></i></a></label>
                <input id="reg_restriction_maildomain" class="form-control ajxtxt" data-desc="Restrict registration" name="reg_restriction_maildomain" value="<?=$settings->reg_restriction_maildomain?>">
            </div>


          </div>
        </div>


      </div>

      <div class="col-md-6">
        <div class="card no-padding">
          <div class="card-body">

            <!-- right -->

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
              <label for="reset_vericode_expiry">Password Reset Vericode Expiry (in minutes) <a href="#!" class="nounderline" title="Note" data-toggle="popover" data-content="Length of time in minutes for expiration of password reset vericodes to email. Maximum: 999999999 (thats nine 9s!). Default: 15"><i class="fa fa-question-circle"></i></a></label>
              <div class="input-group">
                <input type="number" step="1" min="1" max="999999999" class="form-control ajxnum" data-desc="Password Reset Vericode Expiry" name="reset_vericode_expiry" id="reset_vericode_expiry" value="<?=$settings->reset_vericode_expiry?>">
                <span class="input-group-addon">Minutes</span>
              </div>
            </div>



            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="min_un">Minimum Username Length</label>
                  <div class="input-group">
                    <input type="number" step="1" min="1" max="255" class="form-control ajxnum" data-desc="Minimum Username Length" name="min_un" id="min_un" value="<?=$settings->min_un?>">
                    <span class="input-group-addon">characters</span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="max_un">Maximum Username Length</label>
                  <div class="input-group">
                    <input type="number" step="1" min="1" max="255" class="form-control ajxnum" data-desc="Maximum Username Length" name="max_un" id="max_un" value="<?=$settings->max_un?>">
                    <span class="input-group-addon">characters</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="min_pw">Minimum Password Length</label>
                  <div class="input-group">
                    <input type="number" step="1" min="4" max="150" class="form-control ajxnum" data-desc="Minimum Password Length" name="min_pw" id="min_pw" value="<?=$settings->min_pw?>">
                    <span class="input-group-addon">characters</span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="max_pw">Maximum Password Length</label>
                  <div class="input-group">
                    <input type="number" step="1" min="4" max="150" class="form-control ajxnum" data-desc="Maximum Password Length" name="max_pw" id="max_pw" value="<?=$settings->max_pw?>">
                    <span class="input-group-addon">characters</span>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>


      </div>


    </div>

    <input type="hidden" name="csrf" value="<?=Token::generate()?>" />

  </form>

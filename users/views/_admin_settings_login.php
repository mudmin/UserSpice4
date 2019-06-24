<?php $hooks = getMyHooks(['page' =>'admin.php?view=social']); ?>
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
  <form autocomplete="off" class="" action="admin.php?tab=4" name="social" method="post">
    <h2>Social Login Settings</h2>
    <strong>Please note:</strong> Social logins require that you do some configuration on your own with Google and/or Facebook.It is strongly recommended that you  <a href="http://www.userspice.com/documentation-social-logins/" target="_blank"><font color="blue">check the documentation at UserSpice.com.</font></a><br><br>
    <div class="row">
      <div class="col-sm-6">
	  <div class="card no-padding">
		<div class="card-header"><h3>Google Login</h3></div>
		<div class="card-body">

		<!-- left -->
        <div class="form-group">
          <label for="glogin">Enable Google Login</label>
          <span style="float:right;">
            <label class="switch switch-text switch-success">
              <input id="glogin" type="checkbox" class="switch-input toggle" data-desc="Google Login" <?php if($settings->glogin==1) echo 'checked="true"'; ?>>
              <span data-on="Yes" data-off="No" class="switch-label"></span>
              <span class="switch-handle"></span>
            </label>
          </span>
        </div>

        <div class="form-group">
          <label for="gid">Google Client ID</label>
          <input type="password" autocomplete="off" class="form-control ajxtxt" data-desc="Google Client ID" name="gid" id="gid" value="<?=$settings->gid?>">
        </div>

        <div class="form-group">
          <label for="gsecret">Google Client Secret</label>
          <input type="password" autocomplete="off" class="form-control ajxtxt" data-desc="Google Client Secret"  name="gsecret" id="gsecret" value="<?=$settings->gsecret?>">
        </div>

        <div class="form-group">
          <label for="ghome">Full Home URL of Website - include the final /</label>
          <input type="text" class="form-control ajxtxt" data-desc="Home URL"  name="ghome" id="ghome" value="<?=$settings->ghome?>">
        </div>

        <div class="form-group">
          <label for="gredirect">Google Redirect URL (Path to oauth_success.php)</label>
          <input type="text" class="form-control ajxtxt" data-desc="Redirect URL"  name="gredirect" id="gredirect" value="<?=$settings->gredirect?>">
        </div>

		</div>
		</div>

      </div>


      <div class="col-sm-6">
	  <div class="card no-padding">
		<div class="card-header"><h3>Facebook Login</h3></div>
		<div class="card-body">

		<!-- right -->

        <div class="form-group">
          <label for="fblogin">Enable Facebook Login</label>
          <span style="float:right;">
            <label class="switch switch-text switch-success">
              <input id="fblogin" type="checkbox" class="switch-input toggle" data-desc="Facebook Login" <?php if($settings->fblogin==1) echo 'checked="true"'; ?>>
              <span data-on="Yes" data-off="No" class="switch-label"></span>
              <span class="switch-handle"></span>
            </label>
          </span>
        </div>

        <div class="form-group">
          <label for="fbid">Facebook App ID</label>
          <input type="password" class="form-control ajxtxt" data-desc="Facebook App ID" name="fbid" id="fbid" value="<?=$settings->fbid?>">
        </div>

        <div class="form-group">
          <label for="fbsecret">Facebook Secret</label>
          <input type="password" class="form-control ajxtxt" data-desc="Facebook Secret" name="fbsecret" id="fbsecret" value="<?=$settings->fbsecret?>">
        </div>

        <div class="form-group">
          <label for="fbcallback">Facebook Callback URL</label>
          <input type="text" class="form-control ajxtxt" data-desc="Facebook Callback URL" name="fbcallback" id="fbcallback" value="<?=$settings->fbcallback?>">
        </div>

		<div class="form-group">
          <label for="graph_ver">Facebook Graph Version - Formatted as v3.2</label>
          <input type="text" class="form-control ajxtxt" data-desc="Facebook Graph Version" name="graph_ver" id="graph_ver" value="<?=$settings->graph_ver?>">
        </div>

		<div class="form-group">
          <label for="finalredir">Redirect After Facebook Login</label>
          <input type="text" class="form-control ajxtxt" data-desc="Facebook Redirect" name="finalredir" id="finalredir" value="<?=$settings->finalredir?>">
        </div>

		</div>
		</div>

      </div>

    </div>
    <input type="hidden" name="csrf" value="<?=Token::generate()?>" />
  </form>
  <?php includeHook($hooks,'body');?>

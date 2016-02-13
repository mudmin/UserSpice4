<div class="row">
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-file-text fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            You have
            <?php
            echo  "<div class='huge'>{$page_count}</div>"
            ?>
            <div>Pages</div>
          </div>
        </div>
      </div>
      <a href="admin_pages.php">
        <div class="panel-footer">
          <span class="pull-left">Manage Them</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-lock fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            You have
            <?php
            echo  "<div class='huge'>{$level_count}</div>"
            ?>
            <div>Permission Levels</div>
          </div>
        </div>
      </div>
      <a href="admin_permissions.php">
        <div class="panel-footer">
          <span class="pull-left">Manage Them</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-user fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            You have
            <?php
            echo  "<div class='huge'>{$user_count}</div>"
            ?>
            <div> Users</div>
          </div>
        </div>
      </div>
      <a href="admin_users.php">
        <div class="panel-footer">
          <span class="pull-left">Manage Them</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-paper-plane fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            You have

            <div class='huge'>9</div>

            <div>Email Settings</div>
          </div>
        </div>
      </div>
      <?php if($user->data()->id==1){ ?>
        <a href='email_settings.php'>
          <div class='panel-footer'>
            <span class='pull-left'>
              Manage Them</span>
              <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
              <div class='clearfix'></div>
            </div>
          </a>
          <?php }else{ ?>
            <div class='panel-footer'>
              <span class='pull-left'>
                Restricted Area</span>
                <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                <div class='clearfix'></div>
              </div>
              <?php } ?>


            </div>
          </div>
        </div>
        <!-- /.row -->

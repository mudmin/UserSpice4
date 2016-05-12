<div class="col-lg-3 col-md-6">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <div class="row">
        <div class="col-xs-3">
          <i class="fa fa-sign-in fa-5x"></i>
        </div>
        <div class="col-xs-9 text-right">
          Logins
          <?php
          echo  "<div class='huge'>{$numlogins24}</div>"
          ?>
          <div> Today</div>
        </div>
      </div>
    </div>
    <a href="#">
      <div class="panel-footer">
        <span class="pull-left">Something Here?</span>
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
          <i class="fa fa fa-flask fa-5x"></i>
        </div>
        <div class="col-xs-9 text-right">
          Failed Logins
          <?php
          echo  "<div class='huge'>{$noticount}</div>"
          ?>
          <div> Today</div>
        </div>
      </div>
    </div>
    <a href="#">
      <div class="panel-footer">
        <span class="pull-left">Something Here?</span>
        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
        <div class="clearfix"></div>
      </div>
    </a>
  </div>
</div>
</div>
</div>
<!-- /.row -->
<!-- Two FLOT Charts -->
<div class="row">
  <div class="col-xs-12 col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-plus-square"></i> Sign Ups</h3>
      </div>
      <div class="panel-body">
      <div class="flotcontainer" id="flotcontainer0"></div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-sign-in"></i> Sign Ins</h3>
      </div>
      <div class="panel-body">
      <div class="flotcontainer" id="flotcontainer2"></div>
      </div>
    </div>
  </div>

  <div class="col-xs-12 col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-flask"></i> Admin Audit</h3>
      </div>
      <div class="panel-body">
       <div class="acctable table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th>When</th>
          <th>Who</th>
          <th>What</th>
          <th>Why</th>
          <th>Where</th>
         </tr>
        </thead>
        <tbody>
        <?php echo $display_activitydata;?>
        </tbody>
      </table>
      </div>


    </div>
  </div>
</div>
</div> <!-- /row -->
<!-- Two FLOT Charts -->
<div class="row">
  <div class="col-xs-12 col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
      <a class="panel-title" href="admin_permissions.php"><i class="fa fa-fw fa-code"></i>Group Membership</a>
      </div>
      <div class="panel-body">
      <div class="flotcontainer" id="flotcontainer"></div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
      <a class="panel-title" href="admin_pages.php"><i class="fa fa-fw fa-newspaper-o"></i>Pages Privacy</a>
      </div>
      <div class="panel-body">
      <div class="flotcontainer" id="flotcontainer1"></div>
      </div>
    </div>
  </div>

</div> <!-- /row -->

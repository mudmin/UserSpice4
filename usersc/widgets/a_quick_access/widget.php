<div class="row">
<div class="col-sm-12 mb-4">
  <div class="card-group">
    <!-- Begin Users Panel -->
    <?php $count = $db->query("SELECT id from users")->count();?>
    <div class="card col-12  col-md-6 no-padding ">
      <div class="card-body">
        <div class="dropdown float-left">
          <button class="btn bg-transparent dropdown-toggle theme-toggle text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown">
            <i class="fa fa-cog"></i>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <div class="dropdown-menu-content">
              <a class="dropdown-item" href="admin.php?view=users">Manage Users</a>
            </div>
          </div>
        </div>
        <div class="h1 text-muted text-right mb-4">
          <i class="fa fa-users"></i>
        </div>

        <div class="h4 mb-0">
          <span class="count"><?=$count?></span>
        </div>

        <small class="text-muted  font-weight-bold">Users</small>
        <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1" style="width: 40%; height: 5px;"></div>
      </div>
    </div>
    <!-- End Users Panel -->

    <!-- Begin Pages Panel -->
    <?php $count = $db->query("SELECT id from pages")->count();?>
    <div class="card col-12  col-md-6 no-padding ">
      <div class="card-body">
        <div class="dropdown float-left">
          <button class="btn bg-transparent dropdown-toggle theme-toggle text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown">
            <i class="fa fa-cog"></i>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <div class="dropdown-menu-content">
              <a class="dropdown-item" href="admin.php?view=pages">Manage Pages</a>
            </div>
          </div>
        </div>
        <div class="h1 text-muted text-right mb-4">
          <i class="fa fa-file-text"></i>
        </div>

        <div class="h4 mb-0">
          <span class="count"><?=$count?></span>
        </div>

        <small class="text-muted  font-weight-bold">Pages</small>
        <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1" style="width: 40%; height: 5px;"></div>
      </div>
    </div>
    <!-- End Pages Panel -->


    <!-- Begin Permissions Panel -->
    <?php $count = $db->query("SELECT id from permissions")->count();?>
    <div class="card col-12  col-md-6 no-padding ">
      <div class="card-body">
        <div class="dropdown float-left">
          <button class="btn bg-transparent dropdown-toggle theme-toggle text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown">
            <i class="fa fa-cog"></i>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <div class="dropdown-menu-content">
              <a class="dropdown-item" href="admin.php?view=permissions">Manage Permissions</a>
            </div>
          </div>
        </div>
        <div class="h1 text-muted text-right mb-4">
          <i class="fa fa-lock"></i>
        </div>

        <div class="h4 mb-0">
          <span class="count"><?=$count?></span>
        </div>

        <small class="text-muted  font-weight-bold">Permission Levels</small>
        <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1" style="width: 40%; height: 5px;"></div>
      </div>
    </div>
    <!-- End Permissions Panel -->
    <!-- End of Row 1 -->
  </div>
</div>
</div>

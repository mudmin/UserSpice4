<div class="col-sm-8">
  <div class="page-header float-right">
    <div class="page-title">
      <ol class="breadcrumb text-right">
        <li class="active">Dashboard</li>
      </ol>
    </div>
  </div>
</div>
</div>
</header><!-- /header -->
<script src="js/Chart.bundle.js"></script>
<div class="content mt-3">

  <?php
  // UserSpice Announcements
  $filename= 'https://rss.userspice.com/rss.xml';
  $file_headers = @get_headers($filename);
  if(($file_headers[0] != 'HTTP/1.1 200 OK') && ($file_headers[1] != 'HTTP/1.1 200 OK')){
    //logger($user->data()->id,"Errors","UserSpice Announcements feed not found. Please tell UserSpice!");
  } else {
    $limit = 0;
    $dis = $db->query("SELECT * FROM us_announcements")->results();
    $dismissed = [];
    foreach($dis as $d){
      $dismissed[] = $d->dismissed;
    }
    $xmlDoc = new DOMDocument();
    $xmlDoc->load('https://rss.userspice.com/rss.xml');
    $x=$xmlDoc->getElementsByTagName('item');
    for ($i=0; $i<=2; $i++) {
      if($limit == 1){
        continue;
      }

      $dis=$x->item($i)->getElementsByTagName('dis')
      ->item(0)->childNodes->item(0)->nodeValue;

      if(!in_array($dis,$dismissed) && $dis != 0){
        $limit = 1;
        $ignore=$x->item($i)->getElementsByTagName('ignore')
        ->item(0)->childNodes->item(0)->nodeValue;
        $title=$x->item($i)->getElementsByTagName('title')
        ->item(0)->childNodes->item(0)->nodeValue;
        $class=$x->item($i)->getElementsByTagName('class')
        ->item(0)->childNodes->item(0)->nodeValue;
        $link=$x->item($i)->getElementsByTagName('link')
        ->item(0)->childNodes->item(0)->nodeValue;
        $message=$x->item($i)->getElementsByTagName('message')
        ->item(0)->childNodes->item(0)->nodeValue;
        if(version_compare($ignore, $user_spice_ver) !=  1){
          continue;
        }
        ?>
        <div class="sufee-alert alert with-close alert-<?=$class?> alert-dismissible fade show">
          <span class="badge badge-pill badge-<?=$class?>"><?php echo htmlspecialchars($title);?></span> <a href="<?php echo htmlspecialchars($link);?>"><?php echo htmlspecialchars($message);?></a>
          <button type="button" class="close dismiss-announcement" data-dismiss="alert"
          data-dis="<?=$dis?>"
          data-ignore="<?=$ignore?>"
          data-title="<?=$title?>"
          data-class="<?=$class?>"
          data-link="<?=$link?>"
          data-message="<?=$message?>"
          aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php
    }
  }
  }
?>




<div class="col-sm-12 mb-4">

  <div class="card-group">
    <!-- Begin Users Panel -->
    <?php $count = $db->query("SELECT id from users")->count();?>
    <div class="card col-md-6 no-padding ">
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
    <div class="card col-md-6 no-padding ">
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
    <div class="card col-md-6 no-padding ">
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

<!-- Begin Widgets -->
<div class="col-sm-12 mb-6">
  <?php
  $widgets = glob($abs_us_root.$us_url_root.'usersc/widgets/*' , GLOB_ONLYDIR);
  foreach($widgets as $w){
    include($w.'/widget.php');
  }
  ?>
</div>
<!-- End Widgets -->
<!-- admin_panel_buttons.php-->
<?php if(file_exists($abs_us_root.$us_url_root.'usersc/includes/admin_panel_buttons.php')){ ?>
  <div class="col-sm-12 mb-6">
    <?php include($abs_us_root.$us_url_root.'usersc/includes/admin_panel_buttons.php');?>
  </div>
<?php } ?>
<!-- End admin_panel_buttons.php -->
<!-- Important Info -->
<?php
$top = $db->query("SELECT id, logins FROM users ORDER BY logins DESC LIMIT 5")->results();
?>
<div class="col-lg-4 col-md-6">
  <aside class="profile-nav alt">
    <section class="card">
      <div class="card-header user-header alt bg-dark">
        <div class="media">
          <div class="h1 text-light text-left mb-4">
            <i class="fa fa-camera"></i>
          </div>
          <!-- <a href="#">
          <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
        </a> -->
        <div class="media-body">
          <h2 align="center" class="text-light display-6">System Snapshot</h2>
        </div>
      </div>
    </div>


    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        UserSpice Version <span class="badge badge-primary"><?=$user_spice_ver?></span>
        <span class="pull-right"><a href="<?=$us_url_root?>users/admin.php?view=updates">Check for Updates</a></span>
      </li>
      <li class="list-group-item">
        PHP
        <?php
        $ini = php_ini_loaded_file();
        echo $ini;
        ?>
        <span class="badge badge-primary"><?php echo $phpver = phpversion();?>
        </span>
        <span class="pull-right">
          <?php
          if(version_compare('7.1.0',$phpver) ==  1){
            echo "<font color='red'>v7.1 or Greater Suggested</font>";
          }
          ?>
        </span>
      </li>
      <?php $dataB = $db->query("select version()")->results(true);?>
      <li class="list-group-item">
        DB Version <span class="badge badge-primary"><?=$dataB[0]["version()"];?></span>
        <span class="pull-right"></span>
      </li>
      <li class="list-group-item">
        OS Info <span class="badge badge-primary"><?=php_uname('s');?>-<?=php_uname('v');?></span>
        <span class="pull-right"></span>
      </li>
    </ul>
  </section>
</aside>
</div>
<!-- Important Info -->


<!-- Support Info -->
<div class="col-lg-4 col-md-6">
  <aside class="profile-nav alt">
    <section class="card">
      <div class="card-header user-header alt bg-dark">
        <div class="media">
          <div class="h1 text-light text-left mb-4">
            <i class="fa fa-heart"></i>
          </div>
          <!-- <a href="#">
          <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
        </a> -->
        <div class="media-body">
          <h2 align="center" class="text-light display-6">Support Info</h2>
        </div>
      </div>
    </div>


    <ul class="list-group list-group-flush">

      <li class="list-group-item">
        <a href="https://userspice.com/kb/" target="_blank"> <i class="fa fa-book"></i>  Documentation </a>
      </li>

      <li class="list-group-item">
        <a href="https://discord.gg/VgCa6fk" target="_blank"> <i class="fa fa-comments"></i>  Live Discord Chat </a>
      </li>

      <li class="list-group-item">
        <a href="https://userspice.com/forums" target="_blank"> <i class="fa fa-quote-left"></i>  UserSpice Forums </a>
      </li>

      <li class="list-group-item">
        <a href="https://userspice.com/bugs" target="_blank"> <i class="fa fa-bug"></i>  Bug Reports </a>
      </li>
    </ul>
  </section>
</aside>
</div>
<!-- Support Info -->


<!-- Top Users -->
<?php
$top = $db->query("SELECT id, logins FROM users ORDER BY logins DESC LIMIT 4")->results();
?>
<div class="col-lg-4 col-md-6">
  <aside class="profile-nav alt">
    <section class="card">
      <div class="card-header user-header alt bg-dark">
        <div class="media">
          <div class="h1 text-light text-left mb-4">
            <i class="fa fa-trophy"></i>
          </div>
          <!-- <a href="#">
          <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
        </a> -->
        <div class="media-body">
          <h2 align="center" class="text-light display-6">Most Active Users</h2>
        </div>
      </div>
    </div>



    <ul class="list-group list-group-flush">
      <?php
      $count = 1;
      foreach($top as $t){ ?>
        <li class="list-group-item">
          <a href="admin.php?view=users&id=<?=$t->id?>"> #<?=$count?> <?php echoUser($t->id);?> <span class="badge badge-primary pull-right"><?=$t->logins?> logins</span></a>
        </li>
        <?php
        $count++;
      } ?>

    </ul>
  </section>
</aside>
</div>


<!-- End Top Users -->
<!-- Logs -->
<?php $logs = $db->query("SELECT * FROM logs ORDER BY id DESC LIMIT 10")->results(); ?>
<div class="card col-md-12 no-padding ">
  <div class="card">
    <div class="card-header">
      <a href="?view=logs"><i class="fa fa-external-link"></i></a> <strong class="card-title">Last 10 Log Entries <sup><a class="nounderline" data-toggle="tooltip" title="These are generic logs for things that happen around your application.">?</a></sup></strong>
    </div>
    <div class="card-body table-sm table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">IP</th>
            <th scope="col">User</th>
            <th scope="col">Log Type</th>
            <th scope="col">Action</th>
            <th scope="col">Timestamp</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($logs as $m){ ?>
            <tr>
              <td><a href="<?=$us_url_root?>users/admin.php?view=logs&search=<?=$m->ip?>"><?=$m->ip?></a></td>
              <td><?php
              if($m->user_id > 0){
                echouser($m->user_id);
              }?></td>

              <td><?=$m->logtype;?></td>
              <td><?=$m->lognote;?></td>
              <td><?=$m->logdate?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- End Logs -->

<!-- Tables Section -->
<div class="col-sm-12 mb-6">
  <div class="card col-md-12 no-padding ">
    <!-- Tomfoolery -->
    <?php $logs = $db->query("SELECT * FROM audit ORDER BY id DESC LIMIT 10")->results(); ?>
    <div class="card">
      <div class="card-header">
        <a href="?view=security_logs"><i class="fa fa-external-link"></i></a> <strong class="card-title">Last 10 Security Events <sup><a class="nounderline" data-toggle="tooltip" title="Every time a user tries to visit a page that they do not have permission to visit, it is logged here.">?</a></sup></strong>
      </div>
      <div class="card-body table-sm table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Log ID</th>
              <th scope="col">User</th>
              <th scope="col">Page Attempted</th>
              <th scope="col">Timestamp</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($logs as $m){ ?>
              <tr>
                <td><?=$m->id?></td>
                <td><?php
                if($m->user > 0){
                  echouser($m->user);
                }else{
                  $q = $db->query("SELECT * FROM us_ip_list WHERE ip = ? ORDER BY id DESC",array($m->ip));
                  $c = $q->count();
                  if($c > 0){
                    $f = $q->first();
                    echo "IP last used by ";
                    echouser($f->user_id);
                  }else{
                    echo "<font color='red'>Unknown IP</font>";
                  }
                }
                ?></td>

                <td><?php echopage($m->page);?></td>

                <td><?=$m->timestamp?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  $(document).ready(function() {
    //dismiss notifications
    $(".dismiss-announcement").click(function(event) {
      event.preventDefault();
      console.log("clicked");

      var formData = {
        'dismissed' 					: $(this).attr("data-dis"),
        'link' 					: $(this).attr("data-link"),
        'title' 					: $(this).attr("data-title"),
        'class' 					: $(this).attr("data-class"),
        'message' 					: $(this).attr("data-message"),
        'ignore' 					: $(this).attr("data-ignore")
      };
      //
      $.ajax({
        type 		: 'POST',
        url 		: 'parsers/dismiss_announcements.php',
        data 		: formData,
        dataType 	: 'json',
        encode 		: true
      })
    });


  }); //End DocReady
</script>

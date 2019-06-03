<div class="row">

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
  <!-- End Logs -->
</div>
</div>

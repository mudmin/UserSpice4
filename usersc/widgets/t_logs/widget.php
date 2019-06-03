
<div class="row">

  <!-- Logs -->
  <div class="col-sm-12 mb-6">
    <div class="card col-md-12 no-padding ">
  <?php $logs = $db->query("SELECT * FROM logs ORDER BY id DESC LIMIT 10")->results(); ?>
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
</div>
  <!-- End Logs -->
</div>  <!-- End Widget -->
